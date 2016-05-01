<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Participant;

use Redirect;

class HomeController extends Controller
{

    public function home(Request $request)
    {

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
                return Redirect::route('startsurvey');
            }

            // Entire participation is already completed. Reset the participation.
            $request->session()->forget('participant');
            return Redirect::route('home');

        }

        // No participation is underway. We show the homepage.
        return view('tool.home');

    }

}