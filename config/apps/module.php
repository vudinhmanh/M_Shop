<?php
return [
    'module' => [
        [
            'title' => 'QL Bài Viết',
            'icon' => 'fa fa-file',
            'name' => ['post'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Bài Viết',
                    'route' => 'post/catalogue/index',
                ],
                [
                    'title' => 'QL Bài Viết',
                    'route' => 'post/index',
                ],
            ],
        ],
        [
            'title' => 'QL Thành Viên',
            'icon' => 'fa fa-th-large',
            'name' => ['user'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Thành Viên',
                    'route' => 'user/catalogue/index',
                ],
                [
                    'title' => 'QL Thành Viên',
                    'route' => 'user/index',
                ],
            ],
        ],



        [
            'title' => 'Cấu  hình chung',
            'icon' => 'fa fa-file',
            'name' => ['language'],
            'subModule' => [
                [
                    'title' => 'QL Ngôn ngữ',
                    'route' => 'language/index',
                ],
            ],
        ],

    ],
];
