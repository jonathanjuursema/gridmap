@extends('tool.base')

@section('body')

    <? $i = 1; $c = 0; ?>

    <div id="grid-container">
        <div id="grid">
            @for($y = 1; $y <= 20; $y++)
                <div class="gridrow">
                    @for($x = 1; $x <= 25; $x++)

                        <div class="gridcell {{ ($participant->disabledfields && mt_rand(1,500) < 20) ? 'gridcell-disabled' : '' }}"
                             data-x="{{ $x }}" data-y="{{ $y }}">
                            <span class="gridhelper">{{ $i++ }}</span>
                            <span class="gridvalue">{{ $gridnumbers[$c] }}</span>
                        </div>

                        <?
                        if ($i > 7) {
                            $i = 1;
                        }
                        $c++;
                        ?>
                    @endfor
                </div>
            @endfor
        </div>
        <div id="grid-toolbar">

            <div class="pull-right">

                <form class="form-inline" method="post" action="{{ route('recallpassword') }}">

                    {!! csrf_field() !!}

                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your one-time password here." style="width: 400px;">

                    <input type="submit" class="btn btn-success" href="#" role="button" value="Submit">

                </form>

            </div>

            <div class="clearfix"></div>
        </div>
    </div>

    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="aboutModalLabel">Experiment Instructions</h4>
                </div>
                <div class="modal-body" style="text-align: justify;">

                    <p>
                        Thank you for participation in the second phase of our experiment.
                    </p>

                    <p>&nbsp;</p>

                    <h4>Recalling your password</h4>

                    <p>
                        On {{ date('F j', strtotime($participant->updated_at)) }} you picked a password while taking
                        part in the initial phase of our experiment. Now you are tasked to recall this password. Your
                        password consists of a sequence of cells on the grid behind this window. Now, in those cells,
                        are two characters. In order to construct the requested one-time password, you need to put the
                        two characters from each cell in order. See also the example below. You can then enter this
                        one-time password in the password field in the lower right of the screen. Then, you can submit
                        your password using the green button.
                    </p>

                    <p>&nbsp;</p>

                    <h4>Example</h4>

                    <p>
                        If, during the initial phase of the experiment, you chose the most top-left, the most
                        bottom-right, the most top-right and the most bottom-left cells - in that order - your one-time
                        password would be
                        <strong>{{ $gridnumbers[0].$gridnumbers[499].$gridnumbers[24].$gridnumbers[475] }}</strong>.
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Got it!</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('additional-css')

    <style type="text/css">

        #grid {
            width: 100%;

            display: inline-block;
            position: relative;

            margin-top: 20px;

            box-shadow: inset 0px 0px 20px -7px #000;

            background: #333 url('{{ asset('map-backgrounds/' . $participant->map . '.jpg') }}') no-repeat center center;
            background-size: cover;
        }

        #grid-toolbar {
            padding: 5px;
        }

        .gridcell {
            width: 4%;
            height: 100%;
            overflow: hidden;
            float: left;
            font-size: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
            border-right: 1px solid rgba(0, 0, 0, 0.3);

            position: relative;
        }

        .gridvalue {
            position: absolute;
            bottom: 0;
            right: 5px;
            font-size: 20px;
            font-family: monospace;
            color: #fff;
            text-shadow: 0px 0px 5px #000;
        }

        .gridhelper {
            padding: 2px;
            color: rgba(255, 255, 255, 0.8);
            text-shadow: 0px 0px 5px #000;
        }

        .gridcell:nth-child(1) {
            border-left: 1px solid rgba(0, 0, 0, 0.3);
        }

        .gridrow {
            height: 5%;
            width: 100%;
            overflow: hidden;
        }

        .gridrow:nth-child(1) {
            border-top: 1px solid rgba(0, 0, 0, 0.3);
        }

    </style>

@endsection

@section('additional-js')

    <script type="text/javascript">

        function updateGridMapSize() {
            var toolbarheight = 60;
            $("#grid-container").width($(window).width() - 30);
            $("#grid").height(($("#grid-container").width() / 16) * 9);

            if ($("#grid").height() + toolbarheight + 30 > $(window).height()) {
                $("#grid").height($(window).height() - 30 - toolbarheight);
                $("#grid-container").width(($("#grid").height() / 9) * 16);
            }

            $("#password-preview").height($("#grid").height() / 20);

            $(".gridorder").css("line-height", $(".gridorder").height() + "px");

            $("#grid-container").css("margin-left", (($(window).width() - $("#grid").width()) / 2) + "px");
        }

        $(document).ready(function () {

            updateGridMapSize();

            $("#helpModal").modal('show');

        });

        $(window).resize(function () {
            updateGridMapSize();
        });

        var password = [];

    </script>

@endsection