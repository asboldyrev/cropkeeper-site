<?php

return [
    'app_url' => env('CROPKEEPER_APP_URL'),

    'seller' => [
        'name' => env('LANDING_SELLER_NAME'), // [УКАЖИТЕ ФИО / НАИМЕНОВАНИЕ ПРОДАВЦА]
        'status' => env('LANDING_SELLER_STATUS'), // [УКАЖИТЕ СТАТУС: ИП / САМОЗАНЯТЫЙ / ООО]
        'inn' => env('LANDING_SELLER_INN'), // [УКАЖИТЕ ИНН]
        'ogrn' => env('LANDING_SELLER_OGRN'), // [УКАЖИТЕ ОГРНИП / ОГРН, ЕСЛИ ПРИМЕНИМО]
        'address' => env('LANDING_SELLER_ADDRESS'), // [УКАЖИТЕ АДРЕС ДЛЯ ЮРИДИЧЕСКИ ЗНАЧИМЫХ СООБЩЕНИЙ]
        'email' => env('LANDING_CONTACT_EMAIL'), // [УКАЖИТЕ EMAIL]
        'phone' => env('LANDING_CONTACT_PHONE'), // [УКАЖИТЕ ТЕЛЕФОН]
    ],

    'plans' => [
        [
            'code' => 'free',
            'name' => 'Free',
            'eyebrow' => 'Познакомиться с Cropkeeper',
            'description' => 'Все основные возможности для личного сезонного учёта.',
            'featured' => false,
            'features' => [
                'растения, задачи, календарь и журнал',
                '1 список семян',
                'до 20 позиций семян',
                'погодный контекст на главном экране',
            ],
            'purchase_options' => [],
        ],
        [
            'code' => 'pro',
            'name' => 'Pro',
            'eyebrow' => 'Больше места для коллекции',
            'description' => 'Те же инструменты Cropkeeper с увеличенными лимитами для семян.',
            'featured' => true,
            'features' => [
                'все возможности Free',
                'до 5 списков семян',
                'до 100 позиций семян',
            ],
            'purchase_options' => [
                [
                    'title' => 'Доступ на 1 месяц без автопродления',
                    'period' => '1 месяц',
                    'auto_renewal' => false,
                    'price' => env('LANDING_PRO_ACCESS_MONTH_PRICE'),
                ],
                [
                    'title' => 'Доступ на 12 месяцев без автопродления',
                    'period' => '12 месяцев',
                    'auto_renewal' => false,
                    'price' => env('LANDING_PRO_ACCESS_YEAR_PRICE'),
                ],
                [
                    'title' => 'Ежемесячная подписка с автопродлением',
                    'period' => '1 месяц',
                    'auto_renewal' => true,
                    'price' => env('LANDING_PRO_SUBSCRIPTION_MONTH_PRICE'),
                ],
                [
                    'title' => 'Годовая подписка с автопродлением',
                    'period' => '12 месяцев',
                    'auto_renewal' => true,
                    'price' => env('LANDING_PRO_SUBSCRIPTION_YEAR_PRICE'),
                ],
            ],
        ],
        [
            'code' => 'premium',
            'name' => 'Premium',
            'eyebrow' => 'Без ограничений коллекции',
            'description' => 'Максимальные лимиты для тех, кто хранит большую коллекцию семян.',
            'featured' => false,
            'features' => [
                'все возможности Pro',
                'неограниченное количество списков семян',
                'неограниченное количество позиций семян',
            ],
            'purchase_options' => [
                [
                    'title' => 'Доступ на 1 месяц без автопродления',
                    'period' => '1 месяц',
                    'auto_renewal' => false,
                    'price' => env('LANDING_PREMIUM_ACCESS_MONTH_PRICE'),
                ],
                [
                    'title' => 'Доступ на 12 месяцев без автопродления',
                    'period' => '12 месяцев',
                    'auto_renewal' => false,
                    'price' => env('LANDING_PREMIUM_ACCESS_YEAR_PRICE'),
                ],
                [
                    'title' => 'Ежемесячная подписка с автопродлением',
                    'period' => '1 месяц',
                    'auto_renewal' => true,
                    'price' => env('LANDING_PREMIUM_SUBSCRIPTION_MONTH_PRICE'),
                ],
                [
                    'title' => 'Годовая подписка с автопродлением',
                    'period' => '12 месяцев',
                    'auto_renewal' => true,
                    'price' => env('LANDING_PREMIUM_SUBSCRIPTION_YEAR_PRICE'),
                ],
            ],
        ],
    ],

    'roadmap' => [
        [
            'status' => 'Доступно',
            'title' => 'Личный рабочий журнал сезона',
            'items' => [
                'Карточки отдельных посадок с культурой, сортом, датами, статусом и заметками.',
                'Коллекция семян с пользовательскими списками, сортами, количеством и сроками хранения.',
                'Календарь собственных событий и разовые задачи с привязкой к растениям и семенам.',
                'Журнал наблюдений, результатов ухода, проблем и урожая.',
                'Погода по выбранному населённому пункту на главном экране.',
            ],
        ],
        [
            'status' => 'В ближайших обновлениях',
            'title' => 'Больше автоматизации в течение сезона',
            'items' => [
                'Полноценные повторяющиеся задачи для регулярных работ.',
                'Развитие календаря и сезонного планирования.',
                'Улучшение мобильного использования.',
            ],
        ],
        [
            'status' => 'Дальше',
            'title' => 'Глубже в планирование и историю выращивания',
            'items' => [
                'Рекомендации по культурам и сезонным работам по мере наполнения базы.',
                'Расширение справочника культур и данных по выращиванию.',
                'Вложения и дополнительные возможности журнала наблюдений.',
                'Несколько огородов, переключение между ними и совместная работа.',
                'Дальнейшее развитие offline-возможностей.',
            ],
        ],
    ],
];
