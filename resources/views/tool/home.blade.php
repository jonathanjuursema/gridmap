@extends('tool.base')

@section('body')

    <div class="container">

        <div class="row">

            <div class="col-md-6 col-md-offset-3" style="text-align: center;">

                <h1 style="margin: 100px auto;">GridMap Research Tool</h1>

                <p style="text-align: justify;">
                    This is a research tool for a research project conducted by students of the course Cyber-Crime
                    Science at the University of Twente. For more information about the research project and the
                    students involved you can read the information brochure below.
                </p>

                <div class="row" style="margin-top: 50px;">

                    <div class="col-md-6">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#aboutModal"
                           style="width: 200px;">
                            Information Brochure
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a class="btn btn-success" data-toggle="modal" data-target="#consentModal"
                           style="width: 200px;">
                            Take Experiment
                        </a>
                    </div>

                </div>

                <div class="col" style="margin-top: 100px;">

                    <hr>

                    <div class="col-md-6">
                        <a href="https://www.utwente.nl/" target="_blank">University of Twente</a>
                    </div>

                    <div class="col-md-6">
                        <a href="https://www.utwente.nl/en/education/master/programmes/computer-science/specialization/cyber-security/"
                           target="_blank">
                            Computer Security Program
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="aboutModalLabel">Project Information Brochure</h4>
                </div>
                <div class="modal-body" style="text-align: justify;">

                    <p>
                        This web application serves a research project of University of Twente students about GridMaps.
                        To learn more about GridMaps in general, we suggest the
                        <a href="https://dx.doi.org/10.1007/978-3-319-23829-6_6" target="_blank">original paper</a>
                        on them by Nicolas van Balen and Haining Wang. During the experiment you will be asked to create
                        a graphical password. This graphical password will then, anonymously, be analyzed by the
                        researchers. Afterwards you will be asked a few questions related to why you chose a particular
                        graphical password. You will also be asked to take part in the second part of the experiment, in
                        which you will be asked to recall your graphical passwords after a certain time.
                    </p>

                    <p>
                        The initial experiment will take between five and ten minutes, including the time needed to
                        answer the questions. Should you agree to take part in the second part of the experiment you
                        will receive an invitation, via e-mail, up to two times over the coming two months. Those
                        additional experiments are conducted by the same researchers and take about two minutes each.
                        You can take part in the initial experiment without taking part in the second experiment.
                    </p>

                    <p>
                        Any information you disclose while participating in this research will be anonymised and used
                        only for this research. Participation is voluntary, and if at any time you wish to stop
                        participating, you are free to do so.
                    </p>

                    <p>
                        If you would like to participate in this experiment, please click the button on the homepage to
                        start the survey. There you will receive some additional information after which the experiment
                        will start.
                    </p>

                    <p>
                        You can contact the research group by
                        <a href="mailto:j.a.j.juursema@student.utwente.nl">e-mail</a>.
                        The research team consists of Jonathan Juursema, Sven Santema and Christiaan Boersma.
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="consentModal" tabindex="-1" role="dialog" aria-labelledby="consentModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <form method="post" action="{{ route('start') }}">

                    {!! csrf_field() !!}

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="consentModalLabel">{{ ( config('gridmap.open_entries') ? 'Informed Consent' : 'Application Closed' ) }}</h4>
                    </div>

                    <div class="modal-body" style="text-align: justify;">

                        @if(config('gridmap.open_entries'))

                            <p style="font-weight: 700;">
                                In order to participate in our research project, we need you to give consent for
                                involving you in our research project. Please read the consent form below carefully.
                            </p>

                            <p>
                                You are about the participate in a student research project about GridMap passwords.
                                This research project is conducted as part of the Cyber-Crime Science course at the
                                University of Twente, taught by prof. dr. Pieter Hartel and prof. dr. Marianne Junger.
                                This research project has been approved by the Ethical Committee of the faculty of
                                EEMCS. You participate in this research project using your own computer or handheld
                                device.
                            </p>

                            <p>
                                There is no danger in participating in this research project using your own computer or
                                handheld device. Participating in this research will not lead to risks, discomfort or
                                adverse effects of any kind. GridMap passwords are not yet used for authentication
                                purposes, so providing us with a GridMap password has no negative effect on your online
                                security. Any information you disclose while participating in this research will be
                                anonymised, used only for this research and permanently destroyed afterwards.
                                Participation is voluntary, and if at any time you wish to stop participating, you are
                                free to do so. You can stop participating be closing your browser.
                            </p>

                            <p>
                                If you have any questions before taking part of this survey, you can contact the student
                                research group via <a href="mailto:j.a.j.juursema@student.utwente.nl" target="_blank">Jonathan
                                    Juursema</a>.
                            </p>

                            <p>
                                If you have complaints about this research project, you can contact the secretary of the
                                Ethical Committee of the faculty of EEMCS.
                            </p>

                            <div class="checkbox">
                                <label>
                                    <input name="adult" type="checkbox" required>
                                    I am at or above eighteen (18) years of age.
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input name="utwente" type="checkbox" required>
                                    I am either staff or a student of the University of Twente.
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input name="agree" type="checkbox" required>
                                    I have read and understood the above text, and hereby declare that ...
                                </label>
                            </div>

                            <p style="font-style: italic;">
                                ... I have been informed in a manner which is clear to me about the nature and method of
                                the research as described on this website. My questions have been answered to my
                                satisfaction. I agree of my own free will to participate in this research. I reserve the
                                right to withdraw this consent without the need to give any reason and I am aware that I
                                may withdraw from the experiment at any time. If research results related to me are to
                                be used in scientific publications or made public in any other manner, then they will be
                                made completely anonymous. My personal information will not be disclosed to third
                                parties without my express permission.
                            </p>

                        @else

                            <p>

                                Thank you for the interest in our experiment. Unfortunately we are no longer accepting
                                entries as we have moved on to the second phase of the experiment.

                            </p>

                        @endif

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                        @if(config('gridmap.open_entries'))
                            <input type="submit" class="btn btn-success" value="Start the experiment">
                        @endif
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection