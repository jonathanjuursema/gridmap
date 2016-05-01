<?php

namespace app\Console\Commands;

use Illuminate\Console\Command;

use App\Participant;

use Crypt;

class ProcessPasswords extends Command
{

    protected $signature = 'gridmap:process';
    protected $description = 'Process all passwords.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $numberOfPasswords = array(1 => 0, 2 => 0);
        $totalPasswordLength = array(1 => 0, 2 => 0);

        $participants = Participant::all();

        foreach ($participants as $participant) {
            if ($participant->password != null) {

                $password = explode(',', Crypt::decrypt($participant->password));
                $numberOfPasswords[$participant->map]++;
                $totalPasswordLength[$participant->map] += count($password);

            }
        }

    }

}