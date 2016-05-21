<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Open for new experiments
    |--------------------------------------------------------------------------
    |
    | This value determines whether the application accepts new entries.
    |
    */

    'open_entries' => env('NEW_ENTRIES', false),

    /*
    |--------------------------------------------------------------------------
    | Open for recall experiment
    |--------------------------------------------------------------------------
    |
    | This value determines whether the application is open to the recall experiment.
    |
    */

    'open_recall' => env('NEW_RECALL', false),

];
