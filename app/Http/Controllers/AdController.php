<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Input;
use App\Models\Ad;
use App\Models\User;
use App\Models\Category;
use App\Models\Publisher;
use GuzzleHttp\Client;
use App\Rules\GoogleRecaptcha;
use Redirect;
use Session;
use Validator;
use Request;
use Mail;
use Log;

class AdController extends ProjectController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$fields = ['url',
			'title', 'name_' . App::getLocale() . ' AS category',
			'description',
			'place',
			'ads.updated_at'];
		$ads = Ad::where('validated', '=', 1)->simplePaginate(config('App.ads.numberDisplay'));
		$publishers = Ad::withTrashed()->count();
        $students = User::withTrashed()->count();
		return view('ads.index', ['ads' => json_encode($ads), 'myJobs' => false, 'publishers' => $publishers, 'students'=>$students]);
	}

	/**
	 * Show ads created by connected publisher
	 */
	public function created() {
		$fields = ['url',
			'title', 'name_' . App::getLocale() . ' AS category',
			'description',
			'place',
			'ads.updated_at',
		'validated'];

		$publisher = Auth::check() ? Auth::user()->email: Session::get('connected_visitor');
		$ads = Ad::withCategories()->where('contact_email', '=', $publisher)->select($fields)->simplePaginate(config('App.ads.numberDisplay'));
		$publishers = Ad::withTrashed()->count();
        $students = User::withTrashed()->count();
		return view('ads.index', ['ads' => json_encode($ads), 'myJobs' => true, 'publishers' => $publishers, 'students'=>$students]);
	}

	/** Each App 1.0 job creation request redirects its data here. */
	public function bridge() {
		$data = array_map(function($e) { return trim($e); }, Input::all());
		$getOrElse = function($e) use (&$data) { return array_key_exists($e, $data) ? $data[$e] : 'N/A'; };

		$email = $getOrElse('email');
		$bridgedAd = [
			'title' => ucfirst(strtolower($getOrElse('titre'))),
			'category_id' => 9,
			'place' => 'N/A',
			'description' => '[IMPORTED] ' . $getOrElse('description'),
			'starts_at' => date('Y-m-d H:i:s'),
			'ends_at' => null,
			'duration' => $getOrElse('duree') . ' jours',
			'salary' => $getOrElse('renumeration'),
			'skills' => $getOrElse('competence'),
			'languages' => $getOrElse('langues') == '2' ? 'français' : $getOrElse('langues') == '18' ? 'allemand' : 'anglais',
			'contact_first_name' => $getOrElse('contact'),
			'contact_last_name' => '',
			'contact_email' => $email,
			'contact_phone' => null
		];

		Log::debug(print_r($data, true) . print_r($bridgedAd, true));

		if (!Publisher::exists($email)) {
			Publisher::new_publisher($email);
		}

		$ad = Ad::create($bridgedAd);
		Log::info('Bridged ' . e($ad->title) . ' ad.');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$categories = Category::get_id_name_mapping();
		$contact = [];
		if(Auth::user()){
			$contact = Auth::user();
		}
		return view('ads.new', ['categories' => $categories, 'ad' => null, 'contact' => $contact]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		// check if reCaptcha has been validated by Google      
		$secret = env('GOOGLE_RECAPTCHA_SECRET');
		$captchaId = Input::get('g_recaptcha_response');
		
		//sends post request to the URL and tranforms response to JSON
		$responseCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captchaId));
		
		// TODO: remove next comments to activate recaptcha
		//if(!$responseCaptcha->success == true){
		//	return 'bad-captcha';
		//}
		$categories = Category::get_id_name_mapping();
		$validator = Validator::make(Input::all(), $this->adValidation());
		$validator->setAttributeNames(array_map('strtolower', trans('ads.labels')));

		if ($validator->fails()) {
            return $validator->failed();
        }

		/* If this is the first ad with that email,
		create new publisher */

		$email = Input::get('contact_email');
		if (!Publisher::exists($email)) {
			$publisher = Publisher::new_publisher($email);

			Mail::send('emails.publishers', ['email' => $email, 'secret' => $publisher->random_secret], function ($m) use (&$email) {
					$m->to($email)->subject(trans('mails.publishers.link'));
			});

			Log::info("New user ". $email . ", mail sent with admin link");
		}

		$ad = Ad::create(Input::all());

		// Success message
		Session::flash('success', trans('general.successes.adcreated'));

		// Redirection to ad if allowed
		if ($ad->canBeSeen()) {
			return 'done';
		} else {
			return 'done';
		}


	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($url) {
			
		$fields = ['url',
			'title', 'name_' . App::getLocale() . ' AS category', 'place', 'description',
			'starts_at', 'ends_at', 'duration', 'salary', 'skills', 'languages',
			'contact_first_name', 'contact_last_name', 'contact_email', 'contact_phone',
			'validated', 'expires_at', 'ads.updated_at', 'section_ids'];

		$ad = Ad::withCategoriesVisitors()->select($fields)->where('url', '=', $url)->where('validated', '=', 1)->first();;
		return view('ads.show', ['ad' => json_encode($ad)]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function edit($url) {
		$ad = Ad::withVisitors()->findOrFail($url);
		$categories = Category::get_id_name_mapping();
		$now = formatDate();

		if ($ad->starts_at < $now) $ad->starts_at = $now;
		if ($ad->ends_at < $now) $ad->ends_at = null;

		return view('ads.edit', ['categories' => $categories, 'ad' => $ad]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function update($url) {
		$ad = Ad::withVisitors()->findOrFail($url);
		$validator = Validator::make(Input::all(), $this->adValidation());
		$validator->setAttributeNames(array_map('strtolower', trans('ads.labels')));

		if ($validator->fails())
			return back()->withInput()->withErrors($validator);

		if (Input::has('contact_email')) {
			$newContactEmail = Input::get('contact_email');

			if ($newContactEmail != $ad->contact_email && !Publisher::exists($email)) {
				Publisher::new_publisher($email);
			}
		}

		$ad->fill(Input::all());
		$ad->save();

        Log::info('update ad: ' . $ad->url);

        return redirect()->action('AdController@show', $url);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($url) {
		$ad = Ad::withVisitors()->findOrFail($url);
		$ad->delete();

        Log::info('delete ad: ' . $ad->url);

        return redirect()->action('AdController@index');
	}

	/**
	 * Displays the ads created by the person with
	 * the @param $email email
	 */
	public function manage_ads_with_email($email, $secret) {
		if (Publisher::is_valid($secret, $email)) {
			/* Disconnect previous sessions */
			Controller::disconnect();

			/* Temporarily allow current visitor to edit all ads with email $email. */
			Session::put('connected_visitor', $email);
			return redirect()->action('AdController@created');
		} else {
			App::abort(404);
		}
	}

	public function search() {

		if (Auth::guest())
			return redirect()->action('HelpController@index');

		$raw = trim(Input::get('q'));
		if (empty($raw))
			return redirect()->action('AdController@index');

		$terms = explode(' ', $raw);

		$fields = ['url',
			'title', 'name_' . App::getLocale() . ' AS category',
			'description',
			'place',
			'ads.updated_at'];

		$query = Auth::user()->admin ? Ad::withCategories()->select($fields): Ad::acceptedAd()->select($fields);
		$searchFields = ['title', 'description', 'place', 'skills', 'languages', 'name_' . App::getLocale(), 'contact_email'];

		foreach ($terms as $t) {
			$query->where(function ($query) use (&$t, &$searchFields) {
				foreach ($searchFields as $f) {
					$query->Orwhere($f, 'LIKE', '%' . $t . '%');
				}
			});
		}
		$ads = $query->simplePaginate(config('App.ads.numberDisplaySearch'));

        Log::debug('search for ' . e($raw));

		return view('ads.search', ['ads' => $ads, 'search' => $raw]);
	}

	protected function adValidation() {

		$filters = parent::validation('ad');
		$filters['contact_email'][] = 'email';
		$filters['category_id'][] = 'in:' . implode(',', Category::get_id_name_mapping()->keys()->all());
		$filters['starts_at'][] = 'after: -1 day';
		$filters['ends_at'][] = 'after:' . Input::get('starts_at') . ' -1 day';

		$filters = array_map(function ($f) {
			return implode('|', $f);
		}, $filters);

		return $filters;
	}

}
