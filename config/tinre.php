<?php

return [
    'redirect_type' => 302,

    'dashboard_path' => '/dashboard',

    'redirect_user_to_dashboard' => true,

    'roles' => [
        'user',
        'editor',
        'administrator',
    ],

    'default_role' => 'user',

    'default_path_length' => 6,

    'min_path_length' => 6,

    'max_path_length' => 255,

    'restricted_paths' => [
        'api',
        'web',
        'dashboard'
    ],

    'restricted_domains' => [],

    'guest_form' => true,

    'guest_form_custom_path' => true,
];
