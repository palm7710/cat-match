<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PsySH Config
    |--------------------------------------------------------------------------
    |
    | This array allows you to override the default PsySH configuration
    | settings. See https://psysh.org/#config for options.
    |
    */

    'config' => [
        'historyFile' => storage_path('psysh/psysh_history'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Alias Blacklist
    |--------------------------------------------------------------------------
    |
    | PsySH uses an array of internal PHP functions to provide awesome
    | features like tab completion. Unfortunately, you may have your own
    | functions which conflict with the names of PsySH's functions.
    |
    | By listing the conflicting function names in the array below, you can
    | instruct PsySH to avoid using those functions as aliases.
    |
    */

    'blacklist' => [],

];
