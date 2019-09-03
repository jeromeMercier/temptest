<?php

namespace App\Http\Controllers;

use Auth;
use Input;
use Log;

class OptionsController extends ProjectController {

	public function index() {

		$user = Auth::user();

		return view('options.index', ['options' => $user]);
	}

	public function update() {
		$values = [
			'notifications_instant' => Input::get('notifications_instant') ? 1: 0,
			'notifications_day'     => Input::get('notifications_day') ? 1: 0,
			'notifications_week'    => Input::get('notifications_week') ? 1: 0,
		];

		$user = Auth::user();
		$user->fill($values);
		$user->save();

        Log::info('update notifications');

		return 'Notifications updated';
	}

}
