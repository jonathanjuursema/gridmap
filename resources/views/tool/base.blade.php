<!DOCTYPE html>
<head>
    <title>GridMap Research Tool</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:400" rel="stylesheet" type="text/css">

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 400;
            font-family: 'Lato', Arial, sans-serif;
        }
    </style>

    @yield('additional-css')

    @yield('additional-js')

</head>
<body>

@if(Session::has('message'))

    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ Session::get('message') }}
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#messageModal').modal('show')
        });
    </script>

@endif

@yield('body')

</body>
</html>