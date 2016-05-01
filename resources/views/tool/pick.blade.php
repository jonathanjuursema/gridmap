@extends('tool.base')

@section('body')

    <? $i = 1 ?>

    <div id="grid-container">
        <div id="grid">
            @for($y = 1; $y <= 20; $y++)
                <div class="gridrow">
                    @for($x = 1; $x <= 25; $x++)
                        <div class="gridcell {{ ($disabledfields && mt_rand(1,500) < 20) ? 'gridcell-disabled' : '' }}"
                             data-x="{{ $x }}" data-y="{{ $y }}">
                            <span class="gridhelper">{{ $i++ }}</span>
                            <span class="gridvalue"></span>
                            <span class="gridorder"></span>
                        </div>

                        <?
                        if ($i > 7) {
                            $i = 1;
                        }
                        ?>
                    @endfor
                </div>
            @endfor
        </div>
        <div id="grid-toolbar">

            <div id="password-preview" style="width: 50%;">
            </div>

            <div class="pull-right">

                <form class="form-inline" method="post" action="{{ route('savepassword') }}">

                    {!! csrf_field() !!}

                    <input type="hidden" class="form-control" name="password" id="password">

                    <a class="btn btn-default" href="#" role="button" onclick="javascript:clearPassword()">Clear
                        Password</a>

                    <input type="submit" class="btn btn-success" href="#" role="button" value="Submit Password">

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
                        Thank you for participation in our experiment. First you are requested to conjure up a GridMap
                        password. How this works will be explained in the next paragraphs. After picking a GridMap
                        password you will be asked a few questions about the password you picked. Finally you will be
                        asked if you would allow us to contact you once more to see if you can remember you password.
                    </p>

                    <p>&nbsp;</p>

                    <h4>GridMap passwords</h4>

                    <p>
                        A GridMap password, as proposed by Nicolas van Balen and Haining Wang, consists of a set of
                        cells on a map, such as the map on this page. On this map, you can click any amount of cells in
                        any order you want, but you cannot click a cell more than once. The cells you clicked and the
                        order you selected them in is your password. As an indication, your password as you selected it
                        is displayed in the lower left of the page.
                    </p>

                    <p>

                        In the top-left corner of each cell is a number between 1 and 7. This number will always be
                        available when recalling your password and can be used to identify a cell in between similar
                        cells. 

                        @if($disabledfields)
                            On the map you will also find that several cells are blacked out. These cells are randomly
                            chosen and cannot be part of the password you choose.
                        @endif

                    </p>

                    <p>&nbsp;</p>

                    <h4>Saving your password</h4>

                    <p>
                        If you are content with your password and want to save it, click the green button in the lower
                        right of the page. If you want to start over with your password, click the white button in the
                        lower right of the page.
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

            background: #333 url('{{ asset('map-backgrounds/' . $map . '.jpg') }}') no-repeat center center;
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

        .gridcell:hover {
            background-color: rgba(0, 0, 0, 0.5);
            cursor: pointer;
        }

        .gridcell-selected {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .gridcell-disabled, .gridcell-disabled:hover {
            background-color: rgba(0, 0, 0, 1);
        }

        .gridcell-disabled .gridhelper {
            opacity: 0;
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

        #password-preview {
            float: left;
        }

        .gridcell-preview {
            width: 8%;
            border: 1px solid rgba(0, 0, 0, 0.3);
            margin-right: 5px;
            background: #333 url('{{ asset('map-backgrounds/' . $map . '.jpg') }}') no-repeat;
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

            updatePreviewSize();
        }

        function updatePreviewSize() {
            $(".gridcell-preview").each(function () {
                $(this).css("background-size", $("#grid").width() + "px " + $("#grid").height() + "px");
                $(this).css("background-position", "-" + (($(this).data('x') - 1) * ($("#grid").width() / 25)) + "px -" + (($(this).data('y') - 1) * ($("#grid").height() / 20)) + "px");
            });
        }

        function clearPassword() {
            $(".gridcell").removeClass("gridcell-selected").children(".gridorder").html("");
            $("#password-preview").html("");
            password = [];
            $("#password").val("");
        }

        $(document).ready(function () {

            updateGridMapSize();

            $(".gridcell").click(function () {

                if ($(this).hasClass("gridcell-selected") === false && $(this).hasClass("gridcell-disabled") === false && $(this).hasClass("gridcell-preview") === false) {

                    var x = $(this).data("x"), y = $(this).data("y");

                    if (password.length == 0) {
                        $("#password-preview").html();
                    }

                    password.push([x, y]);
                    $(this).addClass("gridcell-selected").children(".gridorder").html(password.length);

                    $("#password").val($("#password").val() + (password.length == 1 ? "" : "," ) + ( x + ((y - 1) * 25)));

                    $("#password-preview").append("<div class='gridcell gridcell-preview' data-x='" + x + "' data-y='" + y + "'></div>");

                    updatePreviewSize();

                }

            });

            $("#helpModal").modal('show');

        });

        $(window).resize(function () {
            updateGridMapSize();
        });

        var password = [];

    </script>

@endsection