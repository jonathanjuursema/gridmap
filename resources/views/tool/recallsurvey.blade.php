@extends('tool.base')

@section('body')

    <div class="container">

        <div class="col">

            <form method="post" action="{{ route('submitrecallsurvey') }}">

                {!! csrf_field() !!}

                <div class="col-md-6 col-md-offset-3" style="text-align: justify;">

                    <h1 style="margin: 100px auto; text-align: center;">Survey</h1>

                    <p>
                        Thank you for taking part in our second experiment.

                        @if ($participant->guessedcorrectly)
                            <strong>Congratulations!</strong> You successfully remembered and recalled your password.
                        @else
                            Unfortunately you have not recalled your password correctly. But thank you for trying.
                        @endif

                        There
                        were {{ floor((strtotime($participant->updated_at) - strtotime($participant->created_at)) / (3600*24)) }}
                        days in between picking your password and recalling it.

                    </p>

                    <p>
                        Below are a few final questions. We would appreciate you filling these out as well. After
                        submitting the survey you will not be contacted again about this experiment, unless you
                        indicated earlier you would like to receive the results.
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
