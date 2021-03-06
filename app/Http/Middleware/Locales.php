<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Config;
use Cookie;
use Input;
use Redirect;
use Session;

class Locales {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		$locales = Config::get('app.available_locales');

		if (in_array(Session::get('locale'), $locales))
			App::setLocale(Session::get('locale'));

		if (Input::has('lang')) {

			$candidate = Input::get('lang');

			if (in_array($candidate, $locales)) {

				App::setLocale($candidate);
				Session::put('locale', $candidate);
				return Redirect::refresh();

			}
		}

		return $next($request);
	}
}
