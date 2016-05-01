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
                        Here be questions!
                    </p>

                    <hr>

                    <p>
                        Can we contact you again in a few weeks to see if you can recall your password? If so, you'll
                        receive one e-mail to ask you to fill in your password. Nothing more. Your e-mail address will
                        be stored encrypted and removed after the project is over.
                    </p>

                    <p>
                        If you'd like to participate in this extended experiment, please provide your e-mail address
                        below. If not, you can leave the field blank.
                    </p>

                    <p>
                        Should you choose to enter your e-mail it will be stored with your selected password and survey
                        answers. It will not be used to identify you in relation with the password.
                    </p>

                    <p>
                        <label for="email">Your e-mail address:</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="j.doe@utwente.nl">
                    </p>

                    <hr>

                    <input type="submit" class="form-control btn btn-success" value="Submit survey">

                </div>

            </form>

        </div>

    </div>

@endsection