<html>

<body>

<p>Dear Sir or Madam,</p>

<p>
    On {{ date('F j', strtotime($participant->updated_at)) }} you participated in an on-line experiment about graphical
    passwords known as GridMap. After taking part you indicated that you would be open to a second experiment in which
    we ask you to recall your graphical password. Via this e-mail we would like to invite you to take part in the second
    phase of our experiment.
</p>

<p>
    If you would still like to take part in the second phase of our experiment you can click

    <a href="{{ route('recall', ['id' => $participant->id, 'secret' => $participant->email]) }}"
       target="_blank">here</a>

    or enter the URL below
    in your browser.
</p>

<p>
    {{ route('recall', ['id' => $participant->id, 'secret' => $participant->email]) }}
</p>

<p>
    If you never participated in our experiment, probably someone entered your e-mail address instead of theirs. If this
    is the case, or if you do not want to participate in the second phase of our experiment anymore, you can discard
    this e-mail. There will be no further e-mails sent to this e-mail address and the database containing this e-mail
    address will be permanently destroyed after the experiment is over. If you - or the one filling in your e-mail
    address - indicated you want to receive the results of our experiment, you will receive one more e-mail with a PDF
    of the final report.
</p>

<p>
    Should this e-mail cause any questions, you can reply on this e-mail to get in touch with the research group. This
    e-mail was automatically generated and is therefore not signed.
</p>

</body>

</html>