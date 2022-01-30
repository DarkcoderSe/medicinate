<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'administrator' => [
            'donation' => 'c,r,u,d',
            'ngo' => 'c,r,u,d',
            'feedback' => 'c,r,u,d',
            'manufacturer' => 'c,r,u,d',
            'setting' => 'c,r,u,d',
            'profile' => 'c,r,u,d'
        ],
        'nhs' => [
            'donation' => 'c,r,u,d',
            'ngo' => 'c,r,u,d',
            'feedback' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'ngo' => [
            'donation' => 'r,u'
        ],
        'member' => [
            'profile' => 'r,u',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
