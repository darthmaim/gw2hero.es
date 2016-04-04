<?php

namespace GW2Heroes\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Input;
use Mail;

class SupportController extends Controller {
    public function getContact() {
        return view('support.contact');
    }

    public function postContact(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => ['required', 'email'],
            'subject' => 'required',
            'body' => 'required'
        ]);

        $name = Input::get('name');
        $email = Input::get('email');
        $subject = Input::get('subject');
        $body = Input::get('body');

        $ua = $request->header('User-Agent');
        $ip = $request->ip();
        $userId = Auth::check() ? Auth::id() : 'guest';

        // send mail to support
        Mail::send(
            ['emails.support_request.html', 'emails.support_request.text'],
            compact(['name', 'email', 'subject', 'body', 'ua', 'ip', 'userId']),
            function(Message $mail) use($name, $email, $subject) {
                $mail->to('info@gw2hero.es', 'GW2Heroes Support')
                    ->replyTo($email, $name)
                    ->from('info@gw2hero.es', 'GW2Heroes Support Request')
                    ->subject('[Support Request] '.$subject);
            }
        );

        return redirect()->action('SupportController@getContactSuccess');
    }

    public function getContactSuccess() {
        return view('support.contactSuccess');
    }

    public function getAbout() {
        return view('support.about');
    }

    public function getTerms() {
        return view('support.tos');
    }

    public function getPrivacy() {
        return view('support.privacy');
    }

    public function getImpressum() {
        return view('support.impressum');
    }

    public function getOffline() {
        return view('errors.offline');
    }

    public function getServiceWorker() {
        return response(view('errors.serviceworker'), 200, ['Content-Type' => 'application/javascript']);
    }
}
