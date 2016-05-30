@extends('tool.base')

@section('body')

    <div class="container">

        <div class="row">

            <div class="col-md-6 col-md-offset-3" style="text-align: center;">

                <h1 style="margin: 100px auto;">Export Data</h1>

                <p style="text-align: center;">
                    <a href="{{ route('export::file') }}" class="btn btn-success">Download CSV</a>
                </p>

            </div>

        </div>

    </div>

@endsection