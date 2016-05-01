<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Participant;

use Redirect;

use Crypt;

class SurveyController extends Controller
{

    public function start(Request $request) {

        // See if there is a participation underway.
        if ($request->session()->has('participant')) {

            // Find participation.
            $participant = Participant::find($request->session()->get('participant'));

            if ($participant == null) {
                // Participation not correctly initialized. Try again.
                $request->session()->forget('participant');
                return Redirect::route('home');
            }

            if ($participant->password == null) {
                // Participation ok. No password picked yet. Pick one now.
                return Redirect::route('pickpassword');
            }

            if (!$participant->survey) {
                // Participation ok. Survey not done yet. Do it now.
                return view('tool.survey');
            }

            // Entire participation is already completed. Reset the participation.
            $request->session()->forget('participant');
            return Redirect::route('home');

        }

        // No participation is underway. We show the homepage.
        return view('tool.home');

    }

    public function submit(Request $request) {

        // See if there is a participation underway.
        if ($request->session()->has('participant')) {

            // Find participation.
            $participant = Participant::find($request->session()->get('participant'));

            if ($participant == null) {
                // Participation not correctly initialized. Try again.
                $request->session()->forget('participant');
                return Redirect::route('home');
            }

            if ($participant->password == null) {
                // Participation ok. No password picked yet. Pick one now.
                return Redirect::route('pickpassword');
            }

            if (!$participant->survey) {
                // Participation ok. Survey not done yet. Process results.
                return $this->processSurvey($request, $participant);
            }

            // Entire participation is already completed. Reset the participation.
            $request->session()->forget('participant');
            return Redirect::route('home');

        }

        // No participation is underway. We show the homepage.
        return view('tool.home');

    }

    private function processSurvey(Request $request, $participant) {

        $request->session()->forget('participant');

        if ($request->email != "") {
            $participant->email = Crypt::encrypt($request->email);
            $request->session()->flash('message', 'Thank you for your participating. You will receive an e-mail to recall your password in a few weeks.');
        } else {
            $request->session()->flash('message', 'Thank you for your participating.');
        }

        $participant->save();

        return Redirect::route('home');

    }

}