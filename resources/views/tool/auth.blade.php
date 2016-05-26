@extends('tool.base')

@section('body')

    <div class="container">

        <div class="row">

            <div class="col-md-6 col-md-offset-3" style="text-align: center;">

                <h1 style="margin: 100px auto;">Management Authentication</h1>

                <p style="text-align: center;">
                    Please enter the management password below to perform any administrative functions.
                </p>

                <form method="post" action="{{ route('auth') }}">

                    {!! csrf_field() !!}

                    <div class="row">
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password"
                                   placeholder="correct horse battery staple">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success">Authorize</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection