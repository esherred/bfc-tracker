<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function set(Request $request) {
        if(
            $request->from_name &&
            $request->from_email &&
            $request->subject
        ) {
            $email = new Email;
            $email->from_name = $request->from_name;
            $email->from_email = $request->from_email;
            $email->subject = $request->subject;
            $email->save();

            return response('Email created', 200);
        }

        return response('No email created', 400);
    }

    public function get() {
        return
        response(Email::all(), 200);
    }

    public function next() {
        $latest = Email::orderBy('id', 'DESC')->limit(1)->get();

        if($latest[0]) {
            return response("Most recent set email ID: {$latest[0]->id}", 200);
        }

        return response("No set emails, next ID will be 1", 200);
    }
}
