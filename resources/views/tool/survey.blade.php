@extends('tool.base')

@section('body')

    <div class="container">

        <div class="col">

            <form method="post" action="{{ route('submitsurvey') }}">

                {!! csrf_field() !!}

                <div class="col-md-6 col-md-offset-3" style="text-align: justify;">

                    <h1 style="margin: 100px auto; text-align: center;">Survey</h1>

                    <p>
                        Thank you for picking a GridMap password. This password has been saved. Now a few questions will
                        follow. Answering these questions shouldn't take more than a minute and will be stored in
                        combination with your password.
                    </p>

                    <hr>

                    <p>
                        Was the concept of GridMaps clear <strong>and</strong> did you understand how selecting and
                        saving a GridMap password works?
                    </p>

                    <label class="radio-inline">
                        <input type="radio" name="question_wasclear" value="1" required> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="question_wasclear" value="0" required> No
                    </label>

                    <hr>

                    <p>
                        Did you base your password on the background image?
                    </p>

                    <label class="radio-inline">
                        <input type="radio" name="question_baseonbg" value="1" required> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="question_baseonbg" value="0" required> No
                    </label>

                    <hr>

                    <p>
                        @if($map == 1)
                            The map depicted the campus of the University of Twente. Did you include a location on the
                            campus you frequently visit in your password?
                        @elseif($map == 2)
                            The map depicted an image of a zoo. Did you include something on the map you feel a personal
                            connection to, like your favorite animal or a booth of your favorite food?
                        @endif
                    </p>

                    <label class="radio-inline">
                        <input type="radio" name="question_association" value="1" required> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="question_association" value="0" required> No
                    </label>

                    <hr>

                    <p>
                        Do you think you'll be able to recall the password you just selected in a few weeks?
                    </p>

                    <label class="radio-inline">
                        <input type="radio" name="question_canrecall" value="1" required> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="question_canrecall" value="0" required> No
                    </label>

                    <hr>

                    <p>
                        Do you think family or friends will be able to guess your password?
                    </p>

                    <label class="radio-inline">
                        <input type="radio" name="question_canguess" value="1" required> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="question_canguess" value="0" required> No
                    </label>

                    <hr>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="question_mayrecall">
                            Can we contact you again once in a few weeks to see if you are able to recall the password you
                            just picked?
                        </label>
                    </div>

                    <br>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="question_wantsresults">
                            Would you like to receive one e-mail containing the report of our experiment?
                        </label>
                    </div>

                    <br>

                    <p>
                        Should you choose to enter your e-mail it will be stored with your selected password and survey
                        answers. It will not be used to identify you in relation with the password.
                    </p>

                    <br>

                    <p>
                        <label for="email">Your e-mail address:</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="j.doe@utwente.nl">
                    </p>

                    <hr>

                    <input id="submit" type="submit" class="form-control btn btn-success" value="Submit survey">

                </div>

            </form>

        </div>

    </div>

@endsection

@section('additional-css')
    <style>

        hr {
            margin: 50px 0;
        }

        #submit {
            margin-bottom: 50px;
        }

    </style>
@endsection