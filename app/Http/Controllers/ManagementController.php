<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;

use Redirect;
use Crypt;

use App\Http\Requests;

class ManagementController extends Controller
{
    public function auth(Request $request)
    {
        if ($request->password == getenv('APP_PASSWORD')) {
            $request->session()->put('admin', true);
            return Redirect::back();
        } else {
            abort(403);
        }
    }

    public function classify(Request $request)
    {

        if (!$request->session()->has('admin')) {
            return view('tool.auth');
        }

        $participation = Participant::whereNotNull('password')->whereNull('has_pattern')->whereNull('has_form')->orderByRaw("RAND()")->first();

        if (!$participation) {
            $request->session()->flash('message', 'There is nothing more to classify!');
            return Redirect::route('home');
        }

        $password = explode(',', Crypt::decrypt($participation->password));

        return view('tool.classify', ['data' => $participation, 'password' => $password]);

    }

    public function classifyPost(Request $request)
    {

        if (!$request->session()->has('admin')) {
            return view('tool.auth');
        }

        $participation = Participant::findOrFail($request->id);

        $participation->has_pattern = $request->has('pattern');
        $participation->has_form = $request->has('form');

        $participation->save();

        return Redirect::route('classify');

    }
}
