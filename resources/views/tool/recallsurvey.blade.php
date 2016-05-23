@extends('tool.base')

@section('body')

    <div class="container">

        <div class="col">

            <form method="post" action="{{ route('submitrecallsurvey') }}">

                {!! csrf_field() !!}

                <div class="col-md-6 col-md-offset-3" style="text-align: justify;">

                    <h1 style="margin: 100px auto; text-align: center;">Survey</h1>

                    <p>
                        Thank you for taking part in our second experiment. Below are a few final questions. We would
                        appreciate you filling these out as well. After submitting the survey you will learn whether you
                        recalled your password correctly.
                    </p>

                    <hr>

                    <p>
                        Was the process of recalling your password on the previous page clear?
                    </p>

                    <label class="radio-inline">
                        <input type="radio" name="question_recallclear" value="1" required> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="question_recallclear" value="0" required> No
                    </label>

                    <hr>

                    <p>
                        Do you think you recalled the right password?
                    </p>

                    <label class="radio-inline">
                        <input type="radio" name="question_thinkwasright" value="1" required> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="question_thinkwasright" value="0" required> No
                    </label>

                    <hr>

                    <p>
                        How would you feel when websites would start using GridMap passwords instead of text-based passwords?
                    </p>

                    <p>
                        <i>I would be ...</i>
                    </p>

                    <div class="radio">
                        <label>
                            <input name="question_opinion" type="radio" value="0" required>
                            ... against it.
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input name="question_opinion" type="radio" value="1" required>
                            ... indifferent.
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input name="question_opinion" type="radio" value="2" required>
                            ... in favor.
                        </label>
                    </div>

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
