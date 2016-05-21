<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Participant;

use Redirect;

class HomeController extends Controller
{

    public function home(Request $request)
    {

        if ($request->session()->has('participant')) {

            $participant = Participant::find($request->session()->get('participant'));

            if ($participant == null) {
                $request->session()->forget('participant');
                return Redirect::route('home');
            }

            return Redirect::route('pickpassword');

        }

        if ($request->session()->has('recall')) {

            $participant = Participant::find($request->session()->get('recall'));

            if ($participant == null) {
                $request->session()->forget('participant');
                return Redirect::route('home');
            }

            return Redirect::route('recallpassword');

        }

        return view('tool.home');

    }

}