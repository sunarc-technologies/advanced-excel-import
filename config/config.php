<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Exclude Field List
    |--------------------------------------------------------------------------
    |
    | List of the fields to be excluded from import process
    |
    */

    'fields_to_be_excluded' => [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Path
    |--------------------------------------------------------------------------
    |
    | Default path where the uploaded excel file should be saved.
    | Default Drive - Public
    |
    */

    'default_path' => 'assets/excel/global',

    /*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | Session lifetime for import process in mints.
    |
    */

    'session_lifetime' => 10,

    'tables' => [
        'import' => [
            "admin_roles",
            "brand_roles",
            "core_versions",
            "countries",
            "newsboard"
        ],
        'exclude' => [
            'migrations',
            'failed_jobs',
            'reset_tokens'
        ]
    ],
];
