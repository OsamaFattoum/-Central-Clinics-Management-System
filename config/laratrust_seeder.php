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
            'case_type' => 'c,r,u,d',
            'pharmacies' => 'c,r,u,d',
            'doctors' => 'c,r,u,d',
            'patients' => 'c,r,u,d',
            'medications' => 'c,r,u,d',
            'appointments' => 'c,r,u,d',
            'records' => 'r',
        ],
        'clinic' => [
            'doctors' => 'c,r,u',
            'clinics_accreditations' => 'r',
        ],
        'pharmacy' => [
            'patients' => 'r',
            'medications' => 'r,s',
        ],
        'doctor' => [
            'records' => 'r',
            'patients' => 'c,r',
            'appointments' => 'r,s,c',
        ],
        'patient' => [],


    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        's' => 'status',
    ],


];
