<?php
/**
 * Created by PhpStorm.
 * User: jonathanj
 * Date: 21-5-2016
 * Time: 15:05
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;

use Redirect;
use Crypt;

class RecallController extends Controller
{

    function start($id, $secret, Request $request)
    {
        if (config('gridmap.open_recall')) {
            $participant = Participant::where('id', $id)->where('email', $secret)->firstOrFail();
            $request->session()->put('recall', $participant->id);

            return Redirect::route('recallpassword');
        } else {
            return Redirect::route('home');
        }
    }

    function recall(Request $request)
    {

        // See if there is a participation underway.
        if ($request->session()->has('recall')) {

            // Find participation.
            $participant = Participant::find($request->session()->get('recall'));

            if ($participant == null) {
                $request->session()->forget('recall');
                return Redirect::route('home');
            }

            if ($participant->guessedcorrectly !== null) {
                return Redirect::route('recallsurvey');
            }

            $chars = [];
            for ($i = 97; $i <= 122; $i++) {
                $chars[] = chr($i);
            }

            $gridnumbers = RecallController::sampling($chars, 2);
            shuffle($gridnumbers);
            $request->session()->put('gridnumbers', $gridnumbers);

            return view('tool.recall', ['participant' => $participant, 'gridnumbers' => $request->session()->get('gridnumbers')]);

        }

        return Redirect::route('home');

    }

    function submit(Request $request)
    {

        // See if there is a participation underway.
        if ($request->session()->has('recall')) {

            // Find participation.
            $participant = Participant::find($request->session()->get('recall'));

            if ($participant == null) {
                $request->session()->forget('recall');
                return Redirect::route('home');
            }

            if ($participant->guessedcorrectly != null) {
                return Redirect::route('recallsurvey');
            }



            if (!(ctype_alpha($request->password) && strlen($request->password) % 2 == 0)) {
                $request->session()->flash('message', 'Your password should consist of an even number of letters.');
                return Redirect::back();
            }

            $participant->guessedcorrectly = (RecallController::translatepassword(strtolower($request->password), $request->session()->get('gridnumbers')) == Crypt::decrypt($participant->password));
            $participant->save();

            $request->session()->forget('gridnumbers');

            return Redirect::route('recallsurvey');

        }

        return Redirect::route('home');

    }

    /**
     * We used this function courtesy of Joel Hinz on stackexchange.
     * http://stackoverflow.com/a/19067884
     */
    static function sampling($chars, $size, $combinations = array())
    {

        # if it's the first iteration, the first set
        # of combinations is the same as the set of characters
        if (empty($combinations)) {
            $combinations = $chars;
        }

        # we're done if we're at size 1
        if ($size == 1) {
            return $combinations;
        }

        # initialise array to put new values in
        $new_combinations = array();

        # loop through existing combinations and character set to create strings
        foreach ($combinations as $combination) {
            foreach ($chars as $char) {
                $new_combinations[] = $combination . $char;
            }
        }

        # call same function again for the next iteration
        return RecallController::sampling($chars, $size - 1, $new_combinations);

    }

    static function translatepassword($onetimepass, $gridnumbers)
    {
        $password = [];
        $onetimepass = preg_split("/([a-z]{2})/", $onetimepass, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        foreach ($onetimepass as $component) {
            $password[] = array_search($component, $gridnumbers) + 1;
        }
        return implode(",", $password);
    }

}