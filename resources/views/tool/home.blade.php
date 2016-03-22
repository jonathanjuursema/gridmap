@extends('tool.base')

@section('body')

    <div class="site-wrapper">

        <div class="site-wrapper-inner">

            <div class="cover-container">

                <div class="masthead clearfix">
                    <div class="inner">
                        <h3 class="masthead-brand">GridMap Research Tool</h3>
                        <nav>
                            <ul class="nav masthead-nav">
                                <li><a href="#about" data-toggle="modal" data-target="#aboutModal">About</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="inner cover">
                    <h1 class="cover-heading">GridMap Research Tool</h1>
                    <p class="lead">
                        This is a research tool for a research project conducted by students of the University of
                        Twente.
                        For more information about the research project and the students involved, click "Learn more"
                        below.
                    </p>
                    <p class="lead">
                        <a href="#" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#aboutModal">Learn
                            more</a>
                        <a href="#" class="btn btn-lg btn-success">Take the survey</a>
                    </p>
                </div>

                <div class="mastfoot">
                    <div class="inner">
                        <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a
                                    href="https://twitter.com/mdo">@mdo</a>.</p>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">About this research tool</h4>
                </div>
                <div class="modal-body">
                    <h4>Research Project</h4>
                    <p>
                        The GridMap Research Project is a project conducted by students at the University of Twente. The
                        study is conducted as part of the course Cyber-Crime Science, part of the Cyber Security master
                        program.
                    </p>
                    <p>
                        The aim of the study is to evaluate gridmaps, a text-based password alternative proposed by
                        Nicolas van Balen and Haining Wang (DOI: 10.1007/978-3-319-23829-6_6).
                    </p>
                    <p>
                        The study is currently pending review from the ethical committee of the faculty of EEMCS at the
                        University of Twente. This research tool is not yet operative.
                    </p>
                    <h4>Students</h4>
                    <p>
                        The research is conducted by Christiaan Boersma, Jonathan Juursema and Sven Santema, supervised
                        by Pieter Hartel.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('additional-css')
    <style>
        /*
 * Globals
 */

        /* Links */
        a,
        a:focus,
        a:hover {
            color: #fff;
        }

        /* Custom default button */
        .btn-default,
        .btn-default:hover,
        .btn-default:focus {
            color: #333;
            text-shadow: none; /* Prevent inheritence from `body` */
            background-color: #fff;
            border: 1px solid #fff;
        }

        /*
         * Base structure
         */

        html,
        body {
            height: 100%;
            background-color: #333;
        }

        /* Extra markup and styles for table-esque vertical and horizontal centering */
        .site-wrapper {
            color: #fff;
            text-align: center;
            text-shadow: 0 1px 3px rgba(0, 0, 0, .5);

            display: table;
            width: 100%;
            height: 100%; /* For at least Firefox */
            min-height: 100%;
            -webkit-box-shadow: inset 0 0 100px rgba(0, 0, 0, .5);
            box-shadow: inset 0 0 100px rgba(0, 0, 0, .5);
        }

        .site-wrapper-inner {
            display: table-cell;
            vertical-align: top;
        }

        .cover-container {
            margin-right: auto;
            margin-left: auto;
        }

        /* Padding for spacing */
        .inner {
            padding: 30px;
        }

        /*
         * Header
         */
        .masthead-brand {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .masthead-nav > li {
            display: inline-block;
        }

        .masthead-nav > li + li {
            margin-left: 20px;
        }

        .masthead-nav > li > a {
            padding-right: 0;
            padding-left: 0;
            font-size: 16px;
            font-weight: bold;
            color: #fff; /* IE8 proofing */
            color: rgba(255, 255, 255, .75);
            border-bottom: 2px solid transparent;
        }

        .masthead-nav > li > a:hover,
        .masthead-nav > li > a:focus {
            background-color: transparent;
            border-bottom-color: #a9a9a9;
            border-bottom-color: rgba(255, 255, 255, .25);
        }

        .masthead-nav > .active > a,
        .masthead-nav > .active > a:hover,
        .masthead-nav > .active > a:focus {
            color: #fff;
            border-bottom-color: #fff;
        }

        @media (min-width: 768px) {
            .masthead-brand {
                float: left;
            }

            .masthead-nav {
                float: right;
            }
        }

        /*
         * Cover
         */

        .cover {
            padding: 0 20px;
        }

        .cover .btn-lg {
            padding: 10px 20px;
            font-weight: bold;
        }

        /*
         * Footer
         */

        .mastfoot {
            color: #999; /* IE8 proofing */
            color: rgba(255, 255, 255, .5);
        }

        /*
         * Affix and center
         */

        @media (min-width: 768px) {
            /* Pull out the header and footer */
            .masthead {
                position: fixed;
                top: 0;
            }

            .mastfoot {
                position: fixed;
                bottom: 0;
            }

            /* Start the vertical centering */
            .site-wrapper-inner {
                vertical-align: middle;
            }

            /* Handle the widths */
            .masthead,
            .mastfoot,
            .cover-container {
                width: 100%; /* Must be percentage or pixels for horizontal alignment */
            }
        }

        @media (min-width: 992px) {
            .masthead,
            .mastfoot,
            .cover-container {
                width: 700px;
            }
        }
    </style>
@endsection