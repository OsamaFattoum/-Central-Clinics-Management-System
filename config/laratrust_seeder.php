<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'departments' => 'c,r,u,d',
            'clinics' => 'c,r,u,d',
            'clinics_accreditations' => 'c,r,u,d',
            'pharmacies' => 'c,r,u,d',
        ],
        'clinic' => [

        ],
        'pharmacy' => [

        ],

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
