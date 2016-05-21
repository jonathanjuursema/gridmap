<?php

namespace app\Console\Commands;

use Illuminate\Console\Command;

use App\Participant;

use Crypt;
use Mail;

class SendEmails extends Command
{

    protected $signature = 'gridmap:email';
    protected $description = 'Send an e-mail to all participants.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        switch ($this->choice('What e-mail would you like to send?', ['recall_invitation', 'results'])) {

            case 'recall_invitation':

                $participants = Participant::where('question_mayrecall', true)->where('emailsent', false)->whereNotNull('email')->get();

                if ($this->confirm("You will be sending this e-mail to " . count($participants) . " participants. Continue?")) {

                    $sent = 0;

                    foreach ($participants as $participant) {

                        Mail::send(['emails.recall', 'emails.recalltext'], ['participant' => $participant], function ($mail) use ($participant) {

                            $mail
                                ->from(env('EMAIL_FROM'), env('EMAIL_NAME'))
                                ->to(Crypt::decrypt($participant->email))
                                ->subject('[GridMap Experiment] Invitation for recalling experiment.')
                                ->replyTo(env('EMAIL_REPLYTO'), env('EMAIL_REPLYTO_NAME'));

                        });

                        $sent++;

                        $participant->emailsent = true;
                        $participant->save();

                        if ($sent % 10 == 0) {
                            $this->info("Sent: $sent out of " . count($participants) . ".");
                        }

                    }

                    $this->info("All e-mails sent.");

                } else {
                    $this->error("Aborting.");
                }

                break;

            case 'results':

                $participants = Participant::where('question_wantsresults', true)->whereNotNull('email')->get();

                $data = "";

                foreach ($participants as $participant) {
                    $data .= Crypt::decrypt($participant->email) . ",";
                }

                $this->info("You need to send this e-mail yourself. Do not forget to attach a PDF with your results!");

                if ($this->confirm('Will you be putting the e-mail addresses of the participants in the CC or TO field of your e-mail?')) {
                    $this->error('You HAVE to e-mail all your participants in the BCC field. Otherwise they will see each others e-mail addresses. Try again.');
                } else {
                    $this->info('You can send your e-mail, with all participants on the BCC, to these e-mail addresses:');
                    $this->line(substr($data, 0, -1));
                }

                break;

            default:
                $this->error('Could not process your answer. Sorry!');
                break;

        }

    }

}