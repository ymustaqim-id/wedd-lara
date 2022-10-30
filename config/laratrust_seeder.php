<?php

return [
    'list_role' => ['superadministrator','admin'],
    'role_structure' => [
        'superadministrator' => [
            'acl-menu' => 'r',
            'users' => 'r',
            'permissions' => 'r',
            'menus' => 'r',
            'roles' => 'r',
        ],
        'admin' => [
        ],
    ],

    // 'permission_structure' => [
    //     'cru_user' => [
    //         'profile' => 'c,r,u'
    //     ],
    // ],


    'permissions_map' => [
        'r' => 'read'
    ]
];
