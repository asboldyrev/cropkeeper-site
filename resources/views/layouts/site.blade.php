<!doctype html>
<html lang="ru">
<head>
    @php
        $canonicalBaseUrl = rtrim((string) config('app.url'), '/');
        $canonicalPath = request()->getPathInfo();
        $canonicalUrl = $seoCanonical ?? $canonicalBaseUrl . $canonicalPath;
        $robotsDirective = $seoRobots ?? 'index, follow';
        $defaultTitle = 'Cropkeeper — порядок в огородном сезоне';
        $defaultDescription = 'Cropkeeper — сервис для ведения огорода: растения, семена, календарь, задачи и журнал сезона.';
        $pageTitle = trim($__env->yieldContent('title')) ?: $defaultTitle;
        $pageDescription = trim($__env->yieldContent('description')) ?: $defaultDescription;
        $keywords = trim($__env->yieldContent('keywords'));
        $socialImage = $seoImage ?? $canonicalBaseUrl . '/images/app.png';
        $openGraphType = $seoOpenGraphType ?? 'website';
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#f5f7f1">
    <meta name="description" content="{{ $pageDescription }}">
    @if ($keywords !== '')
        <meta name="keywords" content="{{ $keywords }}">
    @endif
    <meta name="robots" content="{{ $robotsDirective }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    <meta property="og:site_name" content="Cropkeeper">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="{{ $openGraphType }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $socialImage }}">
    <meta property="og:image:alt" content="Интерфейс Cropkeeper">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $socialImage }}">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/png" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" sizes="180x180">
    <title>{{ $pageTitle }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#main">Перейти к содержанию</a>

    <header class="site-header" data-header>
        <div class="shell site-header__inner">
            <a class="brand" href="{{ route('home') }}" aria-label="Cropkeeper — на главную">
                <span class="brand__mark" aria-hidden="true">
                    <i data-lucide="sprout"></i>
                </span>
                <span class="brand__word">Cropkeeper</span>
            </a>

            <nav class="site-nav" aria-label="Основная навигация">
                <a href="{{ route('home') }}#possibilities">Возможности</a>
                <a href="{{ route('home') }}#plans">Тарифы</a>
                <a href="{{ route('home') }}#roadmap">Роадмап</a>
                @if ($hasSellerDetails)
                    <a href="{{ route('home') }}#contacts">Контакты</a>
                @endif
            </nav>

            <a class="button button--small button--ghost" href="{{ config('landing.app_url') }}">
                Открыть приложение
                <i data-lucide="arrow-up-right" aria-hidden="true"></i>
            </a>
        </div>
    </header>

    <main id="main">
        @yield('content')
    </main>

    <footer class="site-footer" id="contacts">
        <div class="shell site-footer__grid">
            <div class="site-footer__brand">
                <a class="brand" href="{{ route('home') }}">
                    <span class="brand__mark" aria-hidden="true"><i data-lucide="sprout"></i></span>
                    <span class="brand__word">Cropkeeper</span>
                </a>
                <p>Сервис для спокойного планирования и ведения огородного сезона.</p>
            </div>

            <div>
                <p class="footer-label">Документы</p>
                <div class="footer-links">
                    <a href="{{ route('agreement') }}">Пользовательское соглашение</a>
                    <a href="{{ route('offer') }}">Публичная оферта</a>
                    <a href="{{ route('personal-data') }}">Политика обработки персональных данных</a>
                    <a href="{{ route('cookies') }}">Cookies и аналитика</a>
                    @if (config('analytics.metrika.enabled'))
                        <button class="footer-link-button" type="button" data-analytics-settings>Настройки аналитики</button>
                    @endif
                </div>
            </div>

            @if ($hasContactDetails)
                <div>
                    <p class="footer-label">Связь</p>
                    <div class="footer-links footer-links--plain">
                        @if (filled($seller['email'] ?? null))
                            <span>{{ $seller['email'] }}</span>
                        @endif
                        @if (filled($seller['phone'] ?? null))
                            <span>{{ $seller['phone'] }}</span>
                        @endif
                    </div>
                </div>
            @endif

            @if ($hasSellerIdentity)
                <div>
                    <p class="footer-label">Продавец</p>
                    <div class="footer-links footer-links--plain">
                        @if (filled($seller['name'] ?? null))
                            <span>{{ $seller['name'] }}</span>
                        @endif
                        @if (filled($seller['status'] ?? null))
                            <span>{{ $seller['status'] }}</span>
                        @endif
                        @if (filled($seller['inn'] ?? null))
                            <span>ИНН: {{ $seller['inn'] }}</span>
                        @endif
                        @if (filled($seller['ogrn'] ?? null))
                            <span>{{ $seller['ogrn'] }}</span>
                        @endif
                        @if (filled($seller['address'] ?? null))
                            <span>{{ $seller['address'] }}</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="shell site-footer__bottom">
            <span>© {{ date('Y') }} Cropkeeper</span>
            <span>Информация о тарифах и условиях опубликована на этом сайте и может обновляться до оформления покупки.</span>
        </div>
    </footer>

    @if (config('analytics.metrika.enabled'))
        <section
            class="analytics-consent"
            data-analytics-consent
            data-consent-version="{{ config('analytics.consent_version') }}"
            data-metrika-id="{{ config('analytics.metrika.counter_id') }}"
            data-metrika-webvisor="{{ config('analytics.metrika.webvisor') ? 'true' : 'false' }}"
            data-metrika-clickmap="{{ config('analytics.metrika.clickmap') ? 'true' : 'false' }}"
            data-metrika-track-links="{{ config('analytics.metrika.track_links') ? 'true' : 'false' }}"
            data-metrika-accurate-bounce="{{ config('analytics.metrika.accurate_track_bounce') ? 'true' : 'false' }}"
            aria-labelledby="analytics-consent-title"
            hidden
        >
            <div class="analytics-consent__card">
                <div class="analytics-consent__copy">
                    <p class="analytics-consent__eyebrow">Аналитика сайта</p>
                    <h2 id="analytics-consent-title">Помочь улучшать Cropkeeper?</h2>
                    <p>С вашего разрешения мы используем Яндекс Метрику, чтобы понимать, какие публичные страницы полезны посетителям. Без вашего согласия Метрика не запускается.</p>
                    <a href="{{ route('cookies') }}">Подробнее о cookies и аналитике</a>
                </div>
                <div class="analytics-consent__actions">
                    <button class="button button--outline" type="button" data-analytics-reject>Не разрешать</button>
                    <button class="button button--primary" type="button" data-analytics-accept>Разрешить аналитику</button>
                </div>
            </div>
        </section>
    @endif
</body>
</html>