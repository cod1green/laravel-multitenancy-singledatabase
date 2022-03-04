<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Prefix: 'admin'
    |--------------------------------------------------------------------------
    */
    'prefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */
    'admin_email' => env('APP_ADMIN_EMAIL', 'admin@admin.com'),
    'admin_password' => env('APP_ADMIN_PASSWORD', 'admin'),

    /*
    |--------------------------------------------------------------------------
    | Layouts Frontend: index, agency, agency-2, beauty, blog, blog-2, construction, corporate-1, corporate-2, corporate-3,
    | corporate-4, corporate-5, corporate-6, education, gym, hotel, landing, landing-2, logistics, medical, one-page,
    | portfolio, portfolio-2, restaurant, restaurant-2, resume, shop, shop-2, wedding
    |--------------------------------------------------------------------------
    */
    'frontend_layout' => env('APP_LAYOUT_FRONTEND', 'layouts.app'),
    /*

    /*
    |--------------------------------------------------------------------------
    | Layouts Backend: 'adminlte'
    |--------------------------------------------------------------------------
    */
    'backend_layout' => 'layouts.backend.'.env('APP_LAYOUT_BACKEND', 'adminlte'),
    'backend_logo' => 'img/backend/AdminLTELogo.png',
    'backend_site_name' => env('APP_NAME', 'Laravel'),

    /*
    * Color: blue, black, purple, yellow, red, green
    * Ligth: blue-light, purple-light, purple-light
    */
    'color' => 'red',

    /*
    |--------------------------------------------------------------------------
    | Footer
    |--------------------------------------------------------------------------
    */
    'since_year' => env('APP_SINCE_YEAR', date('Y')),
    'produced_by' => env('APP_PRODUCED_BY', 'Cod1green'),
    'produced_url' => env('APP_PRODUCED_URL', 'https://cod1green.com'),
    /*
     * Text Size:  null, 'text-sm'
     */
    'footer_text_size' => null,

    /*
    |--------------------------------------------------------------------------
    | Dates
    |--------------------------------------------------------------------------
    */
    'date_format' => 'Y-m-d',
    'time_format' => 'H:i:s',
    'datetime_format' => 'Y-m-d H:i:s',
    'flatpickr_date_format' => 'Y-m-d',
    'flatpickr_time_format' => 'H:i:S',
    'flatpickr_datetime_format' => 'Y-m-d H:i:S',

    'dates' => [
        'en' => [
            'date_format' => 'Y-m-d',
            'time_format' => 'H:i:s',
            'datetime_format' => 'Y-m-d H:i:s',
        ],
        'pt_BR' => [
            'date_format' => 'd/m/Y',
            'time_format' => 'H:i:s',
            'datetime_format' => 'd/m/Y H:i:s',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Languages
    |--------------------------------------------------------------------------
    */
    'supported_languages' => [
        [
            'title' => 'English',
            'short_code' => 'en',
            'icon' => 'flag-icon flag-icon-us'
        ],
        [
            'title' => 'Português',
            'short_code' => 'pt_BR',
            'icon' => 'flag-icon flag-icon-br',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    */
    'pagination' => [
        'per_page' => 10,
        'options' => [
            10,
            25,
            50,
            100,
        ],
    ],
];
