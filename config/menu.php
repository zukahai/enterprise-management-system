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
                'gate' => 'info.supplier',
                'route' => 'supplier.index',
            ],
            [
                'title' => '👥 Khách hàng',
                'gate' => 'info.customer',
                'route' => 'customer.index',
            ],
            [
                'title' => '👤 Nhân viên',
                'gate' => 'info.staff',
                'route' => 'staff.index',
                'role' => 'admin'
            ],
            [
                'title' => '💰 Ngân hàng',
                'gate' => 'info.bank',
                'route' => 'bank.index',
            ],
        ],
    ],
    [
        'title' => 'Vật liệu',
        'name' => 'materials',
        'icon' => 'ti-package',
        'route' => 'home',
        'children' => [
            [
                'title' => '🛢️ Nguyên liệu',
                'gate' => 'materials.ingredient',
                'route' => 'ingredient.index',
            ],
            [
                'title' => '📦 Thành phẩm',
                'gate' => 'materials.finished-product',
                'route' => 'finished-product.index',
            ],
            [
                'title' => '📐 Đơn vị',
                'gate' => 'materials.unit',
                'route' => 'unit.index',
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
