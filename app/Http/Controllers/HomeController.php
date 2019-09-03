<?php

namespace App\Http\Controllers;

use Auth;
use Input;
use App\Models\FAQ;
use App\Models\Publisher;
use App\Models\Ad;
use App\Models\User;
use Session;
use Validator;

class HomeController extends ProjectController {

    const OLD_ADS_App_1 = 3528;

    public function index() {
        if (Auth::check())
            return redirect()->action('AdController@index');

        $publishers = Ad::withTrashed()->count();
        $students = User::withTrashed()->count();

        return view('home.index', ['publishers' => $publishers, 'students' => $students]);
    }

    public function connect() {
        return redirect()->action('AdController@index');
    }

    public function disconnect() {
        Controller::disconnect();
        return redirect()->action('HomeController@index');
    }

}
