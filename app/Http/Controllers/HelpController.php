<?php

namespace App\Http\Controllers;

use Auth;
use Input;
use App\Models\FAQ;
use Session;
use Validator;
use Mail;
use Log;

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

        $first_name = Input::get('first_name');
        $last_name = Input::get('last_name');
        $email = Input::get('email');
        $message = Input::get('message');
        Mail::send('emails.contact', ['first_name' => $first_name, 'last_name' => $last_name, 'message_content' => $message], function ($m) use (&$first_name, $last_name, $email) {
            $m->from($email, $first_name . ' ' . $last_name);
            $m->to('myjob@epfl.ch')->subject('Contact');
        });

        Log::debug('help mail sent');

        return 'done';
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
