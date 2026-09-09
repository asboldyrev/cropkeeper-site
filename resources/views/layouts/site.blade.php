<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#f5f7f1">
    <meta name="description" content="@yield('description', 'Cropkeeper — сервис для ведения огорода: растения, семена, календарь, задачи и журнал сезона.')">
    <title>@yield('title', 'Cropkeeper — порядок в огородном сезоне')</title>
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
                    <a href="{{ route('offer') }}">Публичная оферта</a>
                    <a href="{{ route('privacy') }}">Политика конфиденциальности</a>
                    <a href="{{ route('personal-data') }}">Политика обработки персональных данных</a>
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
</body>
</html>
