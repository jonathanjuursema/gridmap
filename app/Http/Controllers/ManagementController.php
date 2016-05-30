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

        $participations = Participant::whereNotNull('password')->whereNull('password_category')->orderByRaw("RAND()")->get();

        if (count($participations) === 0) {
            $request->session()->flash('message', 'There is nothing more to classify!');
            return Redirect::route('home');
        }

        $password = explode(',', Crypt::decrypt($participations[0]->password));

        return view('tool.classify', ['data' => $participations[0], 'password' => $password, 'left' => count($participations)]);

    }

    public function classifyPost(Request $request)
    {

        if (!$request->session()->has('admin')) {
            return view('tool.auth');
        }

        $participation = Participant::findOrFail($request->id);

        $participation->password_category = $request->has('cat1') + $request->has('cat2') * 2 + $request->has('cat3') * 4;

        $participation->save();

        return Redirect::route('classify');

    }
}
