<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Set timezone on login
    |--------------------------------------------------------------------------
    |
    | Here you can set the events to detect the user's timezone.
    | Leave empty to forgo this functionality.
    |
    */

    'events' => [
        // \Illuminate\Auth\Events\Login::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Overwrite Existing Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may configure if you would like to overwrite existing
    | timezones if they have been already set in the database.
    |
    */

    'overwrite' => env('TIMEZONE_OVERWRITE', false),

    /*
    |--------------------------------------------------------------------------
    | Overwrite Default Format
    |--------------------------------------------------------------------------
    |
    | Set the default format for displaying dates.
    |
    */

    'format' => env('TIMEZONE_FORMAT', 'F j, Y g:ia'),

    /*
    |--------------------------------------------------------------------------
    | Fallback timezone
    |--------------------------------------------------------------------------
    |
    | Instead of using the app timezone, you can set a fallback timezone
    | to use to display when the user's timezone cannot be determined.
    |
    */

    'fallback' => env('FALLBACK_TIMEZONE', 'UTC'),
];
