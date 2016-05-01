<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Participant;

use Redirect;

use Crypt;

class PasswordController extends Controller
{

    public function pick(Request $request)
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
                return view('tool.pick', ['map' => $participant->map, 'disabledfields' => $participant->disabledfields]);
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
        return Redirect::route('home');

    }

    public function save(Request $request)
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
                // Participation ok. No password picked yet. Save picked one now.
                if ($this->savePassword($request->password, $participant)) {
                    return Redirect::route('startsurvey');
                }
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
        return Redirect::route('home');

    }

    private function savePassword($password, $participant)
    {

        if (!preg_match("/([0-9]{1,3},)*[0-9]{1,3}/i", $password)) {
            return Redirect::route('pickpassword');
        }

        $participant->password = Crypt::encrypt($password);
        $participant->save();

        return true;

    }

}