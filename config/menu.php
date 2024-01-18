<?php
return [
    [
        'title' => 'Hoá đơn',
        'name' => 'invoice',
        'icon' => 'ti-file-dollar',
        'route' => 'home',
        'children' => [
            [
                'title' => 'Hoá đơn',
                'gate' => 'invoice.index',
                'route' => 'home',
            ],
            [
                'title' => 'Thống kê',
                'gate' => 'invoice.analytic',
                'route' => 'home',
            ]
        ],
    ],
    [
        'title' => 'Nhân viên',
        'name' => 'staff',
        'icon' => 'ti-user',
        'route' => 'home',
        'children' => [
            [
                'title' => 'Nhân viên',
                'gate' => 'staff.index',
                'route' => 'staff.index',
            ],
            [
                'title' => 'Thống kê',
                'gate' => 'staff.analytic',
                'route' => 'home',
            ]
        ],
    ]
    
];