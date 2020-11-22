<?php

namespace App\Http\Middleware;

use App;
use Auth;
use Closure;
use Session;

class PublisherAuth {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (Auth::guest() && !Session::has('connected_visitor')) {

			return redirect('connect');
		}

		return $next($request);
	}
}
