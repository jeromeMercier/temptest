<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Ad;
use App\Models\Category;
use Input;

class ModerationController extends ProjectController {

	/**
	 * Display the moderation panel, with the Ads to be moderated
	 */
	public function adsToModerate() {
		$ads_to_moderate = Ad::whereNull('validated_at')->get();

		return view('moderation.list', ['ads_to_moderate' => $ads_to_moderate, 'category_names' => Category::get_id_name_mapping()]);
	}

	public function updateAd($url, $decision){
		$ad = Ad::where('url', '=', $url)->where('deleted_at', '=', NULL)->first();
		$adv2 = Input::all();
		$ad->title = $adv2["title"];
		$ad->description = $adv2["description"];
		$ad->place = $adv2["place"];
		if($decision == 1){
			$ad->validated = true;
		}
		else {
			$ad->validated = false;
		}
		$ad->validated_at = formatDate();
		$ad->save();
		return 'saved';
	}

	public function accept($url) {
        Log::info('accept ad: ' . $url);
		return $this->validity($url, true);
	}

	public function refuse($url) {
        Log::info('refuse ad: ' . $url);
		return $this->validity($url, false);
	}

	public function enable($url) {
        Log::info('enable ad: ' . $url);
		return $this->status($url, formatDate(strtotime('now +' . config('App.ads.validityWeeks') * 7 . 'days')));
	}

	public function disable($url) {
        Log::info('disable ad: ' . $url);
        return $this->status($url, formatDate());
	}

	private function validity($url, $decision) {
		$ad = Ad::findOrFail($url);
		$ad->validated = $decision;
		$ad->validated_at = formatDate();
		$ad->save();
		return redirect()->action('AdController@show', $url);
	}

	private function status($url, $date) {
		$ad = Ad::findOrFail($url);
		$ad->expires_at = $date;
		$ad->save();
		return redirect()->action('AdController@show', $url);
	}


}
