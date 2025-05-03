<?php

return [
    [
        'name' => 'Kinh doanh/Bán hàng',
        'children' => [
            [
                'name' => 'Sales Xuất nhập khẩu/Logistics',
                'children' => [
                    ['name' => 'Sales Logistics'],
                    ['name' => 'Sales Xuất nhập khẩu'],
                    ['name' => 'Sales Xuất nhập khẩu/Logistics khác'],
                ],
            ],
            [
                'name' => 'Sales Bất động sản/Xây dựng',
                'children' => [
                    ['name' => 'Sales Bất động sản/Môi giới bất động sản'],
                    ['name' => 'Kinh doanh thiết bị/vật liệu xây dựng'],
                    ['name' => 'Kinh doanh nội thất'],
                    ['name' => 'Sales Bất động sản/Xây dựng khác'],
                ],
            ],
            [
                'name' => 'Sales Ngành hàng tiêu dùng',
                'children' => [
                    ['name' => 'Kinh doanh siêu thị'],
                    ['name' => 'Kinh doanh bán lẻ'],
                    ['name' => 'Sales Ngành hàng tiêu dùng khác'],
                ],
            ],
            [
                'name' => 'Sales Dịch vụ tài chính',
                'children' => [
                    ['name' => 'Sales bảo hiểm'],
                    ['name' => 'Sales chứng khoán'],
                    ['name' => 'Sales thẻ tín dụng'],
                    ['name' => 'Sales Dịch vụ tài chính khác'],
                ],
            ],
            [
                'name' => 'Sales Khác',
                'children' => [
                    ['name' => 'Sales ô tô'],
                    ['name' => 'Sales phần mềm'],
                    ['name' => 'Sales thiết bị công nghiệp'],
                    ['name' => 'Sales khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Marketing/PR/Quảng cáo',
        'children' => [
            [
                'name' => 'Marketing',
                'children' => [
                    ['name' => 'Digital Marketing'],
                    ['name' => 'Content Marketing'],
                    ['name' => 'Trade Marketing'],
                    ['name' => 'Marketing khác'],
                ],
            ],
            [
                'name' => 'PR',
                'children' => [
                    ['name' => 'Quan hệ công chúng'],
                    ['name' => 'PR khác'],
                ],
            ],
            [
                'name' => 'Quảng cáo',
                'children' => [
                    ['name' => 'Quản lý quảng cáo'],
                    ['name' => 'Quảng cáo khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Công nghệ thông tin',
        'children' => [
            [
                'name' => 'Phát triển phần mềm',
                'children' => [
                    ['name' => 'Lập trình viên Frontend'],
                    ['name' => 'Lập trình viên Backend'],
                    ['name' => 'Lập trình viên Fullstack'],
                    ['name' => 'Phát triển ứng dụng di động'],
                    ['name' => 'Phát triển phần mềm khác'],
                ],
            ],
            [
                'name' => 'Quản trị hệ thống',
                'children' => [
                    ['name' => 'Quản trị mạng'],
                    ['name' => 'Quản trị hệ thống'],
                    ['name' => 'DevOps'],
                    ['name' => 'Quản trị hệ thống khác'],
                ],
            ],
            [
                'name' => 'An ninh mạng',
                'children' => [
                    ['name' => 'Chuyên gia bảo mật'],
                    ['name' => 'An ninh mạng khác'],
                ],
            ],
            [
                'name' => 'Công nghệ thông tin khác',
                'children' => [
                    ['name' => 'Kỹ sư dữ liệu'],
                    ['name' => 'Trí tuệ nhân tạo'],
                    ['name' => 'Công nghệ thông tin khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Tài chính/Kế toán/Kiểm toán',
        'children' => [
            [
                'name' => 'Kế toán',
                'children' => [
                    ['name' => 'Kế toán tổng hợp'],
                    ['name' => 'Kế toán thuế'],
                    ['name' => 'Kế toán công nợ'],
                    ['name' => 'Kế toán khác'],
                ],
            ],
            [
                'name' => 'Kiểm toán',
                'children' => [
                    ['name' => 'Kiểm toán nội bộ'],
                    ['name' => 'Kiểm toán độc lập'],
                    ['name' => 'Kiểm toán khác'],
                ],
            ],
            [
                'name' => 'Tài chính',
                'children' => [
                    ['name' => 'Phân tích tài chính'],
                    ['name' => 'Quản lý đầu tư'],
                    ['name' => 'Tài chính doanh nghiệp'],
                    ['name' => 'Tài chính khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Nhân sự/Hành chính/Pháp lý',
        'children' => [
            [
                'name' => 'Nhân sự',
                'children' => [
                    ['name' => 'Tuyển dụng'],
                    ['name' => 'Đào tạo và phát triển'],
                    ['name' => 'C&B (Lương thưởng và phúc lợi)'],
                    ['name' => 'Nhân sự tổng hợp'],
                    ['name' => 'Nhân sự khác'],
                ],
            ],
            [
                'name' => 'Hành chính',
                'children' => [
                    ['name' => 'Lễ tân'],
                    ['name' => 'Quản lý văn phòng'],
                    ['name' => 'Hành chính khác'],
                ],
            ],
            [
                'name' => 'Pháp lý',
                'children' => [
                    ['name' => 'Luật sư'],
                    ['name' => 'Tư vấn pháp lý'],
                    ['name' => 'Pháp lý khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Giáo dục/Đào tạo',
        'children' => [
            [
                'name' => 'Giảng dạy',
                'children' => [
                    ['name' => 'Giáo viên mầm non'],
                    ['name' => 'Giáo viên tiểu học'],
                    ['name' => 'Giáo viên trung học'],
                    ['name' => 'Giáo viên đại học'],
                    ['name' => 'Giảng dạy khác'],
                ],
            ],

        ],
    ],
    [
        'name' => 'Y tế/Dược',
        'children' => [
            [
                'name' => 'Y tế',
                'children' => [
                    ['name' => 'Bác sĩ'],
                    ['name' => 'Điều dưỡng'],
                    ['name' => 'Kỹ thuật viên y tế'],
                    ['name' => 'Y tế khác'],
                ],
            ],
            [
                'name' => 'Dược',
                'children' => [
                    ['name' => 'Trình dược viên'],
                    ['name' => 'Dược sĩ'],
                    ['name' => 'Dược khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Du lịch/Nhà hàng/Khách sạn',
        'children' => [
            [
                'name' => 'Du lịch',
                'children' => [
                    ['name' => 'Hướng dẫn viên du lịch'],
                    ['name' => 'Điều hành tour'],
                    ['name' => 'Du lịch khác'],
                ],
            ],
            [
                'name' => 'Nhà hàng',
                'children' => [
                    ['name' => 'Quản lý nhà hàng'],
                    ['name' => 'Nhân viên phục vụ'],
                    ['name' => 'Nhà hàng khác'],
                ],
            ],
            [
                'name' => 'Khách sạn',
                'children' => [
                    ['name' => 'Quản lý khách sạn'],
                    ['name' => 'Lễ tân khách sạn'],
                    ['name' => 'Buồng phòng'],
                    ['name' => 'Khách sạn khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Xây dựng',
        'children' => [
            [
                'name' => 'Thiết kế/Kiến trúc',
                'children' => [
                    ['name' => 'Kiến trúc sư'],
                    ['name' => 'Thiết kế nội thất'],
                    ['name' => 'Thiết kế/Kiến trúc khác'],
                ],
            ],
            [
                'name' => 'Kỹ thuật xây dựng',
                'children' => [
                    ['name' => 'Kỹ sư xây dựng'],
                    ['name' => 'Giám sát công trình'],
                    ['name' => 'Kỹ thuật xây dựng khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Sản xuất/Vận hành sản xuất',
        'children' => [
            [
                'name' => 'Cơ khí/Chế tạo',
                'children' => [
                    ['name' => 'Kỹ sư cơ khí'],
                    ['name' => 'Thợ hàn'],
                    ['name' => 'Cơ khí/Chế tạo khác'],
                ],
            ],
            [
                'name' => 'Điện/Điện tử',
                'children' => [
                    ['name' => 'Kỹ sư điện'],
                    ['name' => 'Kỹ thuật viên điện tử'],
                    ['name' => 'Điện/Điện tử khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Vận tải/Kho vận',
        'children' => [
            [
                'name' => 'Logistics',
                'children' => [
                    ['name' => 'Nhân viên logistics'],
                    ['name' => 'Quản lý kho'],
                    ['name' => 'Logistics khác'],
                ],
            ],
            [
                'name' => 'Vận tải',
                'children' => [
                    ['name' => 'Lái xe'],
                    ['name' => 'Điều phối vận tải'],
                    ['name' => 'Vận tải khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Truyền thông/Quảng cáo',
        'children' => [
            [
                'name' => 'Truyền thông',
                'children' => [
                    ['name' => 'Chuyên viên truyền thông'],
                    ['name' => 'Biên tập viên'],
                    ['name' => 'Truyền thông khác'],
                ],
            ],
            [
                'name' => 'Quảng cáo',
                'children' => [
                    ['name' => 'Chuyên viên quảng cáo'],
                    ['name' => 'Thiết kế quảng cáo'],
                    ['name' => 'Quảng cáo khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Thiết kế/Mỹ thuật',
        'children' => [
            [
                'name' => 'Thiết kế đồ họa',
                'children' => [
                    ['name' => 'Designer'],
                    ['name' => 'Thiết kế 3D'],
                    ['name' => 'Thiết kế đồ họa khác'],
                ],
            ],
            [
                'name' => 'Mỹ thuật',
                'children' => [
                    ['name' => 'Họa sĩ'],
                    ['name' => 'Điêu khắc'],
                    ['name' => 'Mỹ thuật khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Ngân hàng/Chứng khoán/Đầu tư',
        'children' => [
            [
                'name' => 'Ngân hàng',
                'children' => [
                    ['name' => 'Giao dịch viên'],
                    ['name' => 'Tín dụng'],
                    ['name' => 'Ngân hàng khác'],
                ],
            ],
            [
                'name' => 'Chứng khoán',
                'children' => [
                    ['name' => 'Môi giới chứng khoán'],
                    ['name' => 'Phân tích chứng khoán'],
                    ['name' => 'Chứng khoán khác'],
                ],
            ],
            [
                'name' => 'Đầu tư',
                'children' => [
                    ['name' => 'Chuyên viên đầu tư'],
                    ['name' => 'Quản lý quỹ'],
                    ['name' => 'Đầu tư khác'],
                ],
            ],
        ],
    ],
    [
        'name' => 'Bảo hiểm',
        'children' => [
            [
                'name' => 'Tư vấn bảo hiểm',
                'children' => [
                    ['name' => 'Tư vấn viên'],
                    ['name' => 'Quản lý đại lý'],
                    ['name' => 'Tư vấn bảo hiểm khác'],
                ],
            ],
            [
                'name' => 'Thẩm định bảo hiểm',
                'children' => [
                    ['name' => 'Thẩm định viên'],
                    ['name' => 'Giám định viên'],
                    ['name' => 'Thẩm định bảo hiểm khác'],
                ],
            ],
        ],
    ],
];




