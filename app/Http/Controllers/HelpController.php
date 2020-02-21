<?php

namespace App\Http\Controllers;

use Auth;
use Input;
use App\Models\FAQ;
use Session;
use Validator;

class HelpController extends ProjectController {

    public function index() {
        $faq_items_array = FAQ::all();
        $contact = [];
        if(Auth::user()){
          $contact = Auth::user();
        }
        return view('help.index', ['faq_items_array' => $faq_items_array, 'contact' => $contact]);
    }

    public function send() {

        $validator = Validator::make(Input::all(), $this->contactValidation());
        $validator->setAttributeNames(array_map('strtolower', trans('contacts.placeholders')));

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $first_name = e(Input::get('first_name'));
        $last_name = e(Input::get('last_name'));
        $email = e(Input::get('email'));
        $message = e(Input::get('message'));

        Mail::raw($message, function ($message) use (&$first_name, &$last_name, &$email) {
            $message->from($email, $first_name . ' ' . $last_name);
            $message->to('App@epfl.ch')->subject('App contact');
        });

        Log::debug('help mail sent');

        return redirect()->action('HelpController@index')->with('success', trans('general.successes.sent'));
    }

    private function contactValidation() {

        $filters = parent::validation('contact');

        $filters['email'][] = 'email';

        $filters = array_map(function ($f) {
            return implode('|', $f);
        }, $filters);

        return $filters;
    }

}
