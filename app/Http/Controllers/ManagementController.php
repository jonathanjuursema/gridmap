<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;

use Redirect;
use Crypt;
use Response;

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

    public function export(Request $request) {

        if (!$request->session()->has('admin')) {
            return view('tool.auth');
        }

        return view('tool.export');

    }

    public function exportData(Request $request)
    {

        if (!$request->session()->has('admin')) {
            return view('tool.auth');
        }

        $participants = Participant::all();

        $data = array([
            "Map",
            "DisabledFields",
            "PasswordLength",
            "Cat1",
            "Cat2",
            "Cat3",
            "GuessedCorrectly",
            "DidSurvey",
            "DidRecallSurvey",
            "WasClear",
            "BasedOnBackground",
            "AssociationWithBackground",
            "ThinkCanRecall",
            "ThinkOthersCanGuess",
            "ThinkRecalledRight",
            "Opinion",
            "RecallWasClear"
        ]);

        foreach ($participants as $participant) {

            $data[] = array(
                $participant->map,
                $participant->disabledfields,
                count(explode(',', Crypt::decrypt($participant->password))),
                (($participant->password_category & 1) == 1 ? 1 : 0),
                (($participant->password_category & 2) == 2 ? 1 : 0),
                (($participant->password_category & 4) == 4 ? 1 : 0),
                $participant->guesscorrectly,
                $participant->survey,
                $participant->recallsurvey,
                $participant->question_wasclear,
                $participant->question_baseonbg,
                $participant->question_association,
                $participant->question_canrecall,
                $participant->question_canguess,
                $participant->question_thinkwasright,
                $participant->question_opinion,
                $participant->question_recallclear
            );

        }

        $response = "";

        foreach($data as $datarow) {
            $response = $response . implode(",", $datarow) . "\r\n";
        }

        $headers = ['Content-type'=>'text/plain', 'Content-Disposition'=>sprintf('attachment; filename="%s"', "gridmap-export.csv"),'Content-Length'=>sizeof($response)];

        return Response::make($response, 200, $headers);

    }

}
