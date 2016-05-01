<?php
/**
 * Created by PhpStorm.
 * User: jonathanj
 * Date: 1-5-2016
 * Time: 19:35
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Participant;

use Redirect;

class StartController extends Controller
{

    public function start(Request $request)
    {

        if (!$request->adult || !$request->utwente || !$request->agree) {

            // If not all consent is given, stop and go back.
            return Redirect::route('home');

        }

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

        // We can successfully start a new participation.
        return $this->startNewParticipation($request);

    }

    private function startNewParticipation(Request $request) {

        $participant = new Participant();
        $participant->map = mt_rand(1,2);
        $participant->disabledfields = mt_rand(0, 1);
        $participant->save();

        $request->session()->put('participant', $participant->id);

        return Redirect::route('pickpassword');

    }

}