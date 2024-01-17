<?php
return [
    [
        'title' => 'Nhân viên',
        'name' => 'staff',
        'icon' => 'ti-user',
        'route' => 'index',
        'children' => [
            [
                'title' => 'Nhân viên',
                'gate' => 'staff.index',
                'route' => 'staff.index',
            ],
            [
                'title' => 'Thống kê',
                'gate' => 'staff.analytic',
                'route' => 'index',
            ]
        ],
    ],
    [
        'title' => 'Hoá đơn',
        'name' => 'invoice',
        'icon' => 'ti-file-dollar',
        'route' => 'index',
        'children' => [
            [
                'title' => 'Hoá đơn',
                'gate' => 'invoice.index',
                'route' => 'index',
            ],
            [
                'title' => 'Thống kê',
                'gate' => 'invoice.analytic',
                'route' => 'index',
            ]
        ],
    ]

];