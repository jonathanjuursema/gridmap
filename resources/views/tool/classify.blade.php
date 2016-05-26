@extends('tool.base')

@section('body')

    <? $c = 1; ?>

    <div id="grid-container">
        <div id="grid">
            @for($y = 1; $y <= 20; $y++)
                <div class="gridrow">
                    @for($x = 1; $x <= 25; $x++)

                        <div class="gridcell {{ (array_search($c, $password) !== false ? 'used' : '') }}">
                            <span class="gridorder">{{ (array_search($c, $password) !== false ? array_search($c, $password) + 1 : '') }}</span>
                        </div>

                        <?
                        $c++;
                        ?>
                    @endfor
                </div>
            @endfor
        </div>
        <div id="grid-toolbar">

            <div class="pull-right">

                <form class="form-inline" method="post" action="{{ route('classify') }}">

                    {!! csrf_field() !!}

                    <input type="hidden" name="id" value="{{ $data->id }}">

                    <div class="checkbox" style="margin-right: 25px;">
                        <label>
                            <input type="checkbox" name="pattern" value="yes">
                            This password has a pattern.
                        </label>
                    </div>

                    <div class="checkbox" style="margin-right: 25px;">
                        <label>
                            <input type="checkbox" name="form" value="yes">
                            This password has a form.
                        </label>
                    </div>

                    <input type="submit" class="btn btn-success" href="#" role="button" value="Submit ({{ $left }} to go)">

                </form>

            </div>

            <div class="clearfix"></div>
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

        .gridcell.used {
            background-color: #333;
        }

        .gridorder {
            position: absolute;
            top: 0px;
            left: 0px;
            right: 0px;
            bottom: 0px;
            text-align: center;
            font-size: 18px;

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

        });

        $(window).resize(function () {
            updateGridMapSize();
        });

    </script>

@endsection