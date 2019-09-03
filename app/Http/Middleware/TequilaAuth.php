<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Agepinfo\Tequila;
use Session;

class TequilaAuth {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (Auth::guest()) {
			Session::flash('intended', $request->path());
			return Tequila::auth();
		}

		return $next($request);
	}
}
