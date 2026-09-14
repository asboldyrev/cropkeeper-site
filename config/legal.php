<?php

return [
    'documents' => [
        'agreement' => [
            'title' => 'Пользовательское соглашение',
            'canonical_route' => 'agreement',
            'current' => [
                'revision' => '2026-09-14',
                'label' => 'Редакция от 14 сентября 2026 года',
                'effective_from' => '2026-09-14',
                'view' => 'legal.agreement',
            ],
            'archive' => [],
        ],
        'offer' => [
            'title' => 'Публичная оферта',
            'canonical_route' => 'offer',
            'current' => [
                'revision' => '2026-09-14',
                'label' => 'Редакция от 14 сентября 2026 года',
                'effective_from' => '2026-09-14',
                'view' => 'legal.offer',
            ],
            'archive' => [
                [
                    'revision' => '2026-09-05',
                    'label' => 'Редакция от 5 сентября 2026 года',
                    'effective_from' => '2026-09-05',
                    'view' => 'legal.archive.offer.2026-09-05',
                ],
            ],
        ],
        'personal-data' => [
            'title' => 'Политика обработки персональных данных',
            'canonical_route' => 'personal-data',
            'current' => [
                'revision' => '2026-09-14',
                'label' => 'Редакция от 14 сентября 2026 года',
                'effective_from' => '2026-09-14',
                'view' => 'legal.personal-data',
            ],
            'archive' => [
                [
                    'revision' => '2026-09-05',
                    'label' => 'Редакция от 5 сентября 2026 года',
                    'effective_from' => '2026-09-05',
                    'view' => 'legal.archive.personal-data.2026-09-05',
                ],
            ],
        ],
        'cookies' => [
            'title' => 'Cookies и аналитика',
            'canonical_route' => 'cookies',
            'current' => [
                'revision' => '2026-09-14',
                'label' => 'Редакция от 14 сентября 2026 года',
                'effective_from' => '2026-09-14',
                'view' => 'legal.cookies',
            ],
            'archive' => [],
        ],
        'privacy' => [
            'title' => 'Политика конфиденциальности',
            'canonical_route' => null,
            'current' => null,
            'archive' => [
                [
                    'revision' => '2026-09-05',
                    'label' => 'Редакция от 5 сентября 2026 года',
                    'effective_from' => '2026-09-05',
                    'view' => 'legal.archive.privacy.2026-09-05',
                ],
            ],
        ],
    ],
];
