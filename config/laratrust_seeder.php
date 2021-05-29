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
            'users' => 'c,r,u,d',
            'reported-issues' => 'c,r,u,d',
            'feedback' => 'c,r,u,d',
            'catalog' => 'c,r,u,d',
            'category' => 'c,r,u,d',
            'tools' => 'c,r,u,d', 
            'general' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'manager' => [
            'users' => 'r,u',
            'reported-issues' => 'c,r,u',
            'feedback' => 'c,r,u',
            'catalog' => 'c,r,u',
            'category' => 'c,r,u', 
            'general' => 'c,r,u',
            'profile' => 'r,u'
        ],
        'expert' => [
            'catalog' => 'r,u',
            'general' => 'r,u',
            'profile' => 'r,u'
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
