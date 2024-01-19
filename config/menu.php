<?php
return [
    [
        'title' => 'Thông tin cơ bản',
        'name' => 'info',
        'icon' => 'ti-file-dollar',
        'route' => 'home',
        'children' => [
            [
                'title' => '🏭 Nhà cung cấp',
                'gate' => 'info.index',
                'route' => 'home',
            ],
            [
                'title' => '👥 Khách hàng',
                'gate' => 'info.customer',
                'route' => 'home',
            ],
            [
                'title' => '👤 Nhân viên',
                'gate' => 'info.staff',
                'route' => 'staff.index',
                'role' => 'admin'
            ],
            [
                'title' => '💰 Ngân hàng',
                'gate' => 'info.customer',
                'route' => 'home',
            ],
        ],
    ],
    [
        'title' => 'Vật liệu',
        'name' => 'info2',
        'icon' => 'ti-package',
        'route' => 'home',
        'children' => [
            [
                'title' => '🛢️ Nguyên liệu',
                'gate' => 'info.index',
                'route' => 'home',
            ],
            [
                'title' => '📦 Thành phẩm',
                'gate' => 'info.customer',
                'route' => 'home',
            ]
        ],
    ],
    [
        'title' => 'Đặt hàng và giao nhận',
        'name' => 'info3',
        'icon' => 'ti-truck',
        'route' => 'home',
        'children' => [
            [
                'title' => '📤 Đơn hàng xuất',
                'gate' => 'info.index',
                'route' => 'home',
            ],
            [
                'title' => '📥 Đơn hàng nhập',
                'gate' => 'info.index',
                'route' => 'home',
            ],
            [
                'title' => '🚚 Xuất giao hàng',
                'gate' => 'info.customer',
                'route' => 'home',
            ],
            [
                'title' => '💵 Hoá đơn bán hàng',
                'gate' => 'info.customer',
                'route' => 'home',
            ],
            [
                'title' => '🚛 Nhập giao hàng',
                'gate' => 'info.customer',
                'route' => 'home',
            ]
        ],
    ],
    [
        'title' => 'Giao dịch mua bán',
        'name' => 'invoice4',
        'icon' => 'ti-receipt',
        'route' => 'home',
        'children' => [
            [
                'title' => '💸 Hoá đơn mua hàng',
                'gate' => 'invoice.index',
                'route' => 'home',
            ],
            [
                'title' => '💳 Phiếu chi',
                'gate' => 'invoice.analytic',
                'route' => 'home',
            ],
            [
                'title' => '💰 Phiếu thu',
                'gate' => 'invoice.analytic',
                'route' => 'home',
            ]
        ],
    ],
    [
        'title' => 'Quản lí thu chi',
        'name' => 'invoice5',
        'icon' => 'ti-wallet',
        'route' => 'home',
        'children' => [
            [
                'title' => '📊 Loại thu chi',
                'gate' => 'invoice.index',
                'route' => 'home',
            ]
        ],
    ],
    [
        'title' => 'Quản lí kế toán',
        'name' => 'invoice6',
        'icon' => 'ti-clipboard',
        'route' => 'home',
        'children' => [
            [
                'title' => '📑 Bảng kê nhập hàng',
                'gate' => 'invoice.index',
                'route' => 'home',
            ]
        ],
    ]
    
];
