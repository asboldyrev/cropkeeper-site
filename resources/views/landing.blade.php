@extends('layouts.site')

@section('title', 'Cropkeeper — порядок в огородном сезоне')
@section('description', 'Cropkeeper помогает вести огороды, растения, семена, календарь, задачи и журнал сезона в одном месте.')

@section('content')
    <section class="hero">
        <div class="shell hero__grid">
            <div class="hero__copy">
                <p class="eyebrow"><span></span> Огородный сезон без разрозненных заметок</p>
                <h1>Помните, что растёт. Знайте, что делать дальше.</h1>
                <p class="hero__lead">
                    Cropkeeper собирает огороды, растения, семена, календарь, задачи и журнал наблюдений в одном спокойном рабочем пространстве.
                </p>
                <div class="hero__actions">
                    <a class="button button--primary" href="{{ config('landing.app_url') }}">
                        Открыть Cropkeeper
                        <i data-lucide="arrow-right" aria-hidden="true"></i>
                    </a>
                    <a class="button button--text" href="#possibilities">Посмотреть возможности</a>
                </div>
                <div class="hero__facts" aria-label="Ключевые свойства Cropkeeper">
                    <span><i data-lucide="check" aria-hidden="true"></i> Бесплатный тариф</span>
                    <span><i data-lucide="check" aria-hidden="true"></i> Без установки</span>
                    <span><i data-lucide="check" aria-hidden="true"></i> Работает на телефоне и компьютере</span>
                </div>
            </div>

            <div class="season-board" aria-label="Пример организации сезона в Cropkeeper">
                <div class="season-board__top">
                    <div>
                        <span class="season-board__caption">Сезон · сентябрь</span>
                        <strong>Огород у дома</strong>
                    </div>
                    <span class="season-board__weather" aria-label="Пример погодного контекста">
                        <i data-lucide="cloud-sun" aria-hidden="true"></i> +18°
                    </span>
                </div>

                <div class="season-board__beds">
                    <article class="garden-bed garden-bed--tomato">
                        <div class="garden-bed__icon"><i data-lucide="sprout" aria-hidden="true"></i></div>
                        <div>
                            <span>Грядка 01</span>
                            <strong>Томаты</strong>
                            <small>8 растений</small>
                        </div>
                    </article>
                    <article class="garden-bed garden-bed--greens">
                        <div class="garden-bed__icon"><i data-lucide="leaf" aria-hidden="true"></i></div>
                        <div>
                            <span>Грядка 02</span>
                            <strong>Зелень</strong>
                            <small>4 культуры</small>
                        </div>
                    </article>
                    <article class="garden-bed garden-bed--root">
                        <div class="garden-bed__icon"><i data-lucide="carrot" aria-hidden="true"></i></div>
                        <div>
                            <span>Грядка 03</span>
                            <strong>Корнеплоды</strong>
                            <small>3 культуры</small>
                        </div>
                    </article>
                </div>

                <div class="season-board__agenda">
                    <div class="season-board__agenda-heading">
                        <span>Ближайшие дела</span>
                        <span>3 задачи</span>
                    </div>
                    <div class="agenda-row">
                        <span class="agenda-row__date">07</span>
                        <span class="agenda-row__marker"></span>
                        <div><strong>Собрать томаты</strong><small>Огород у дома</small></div>
                        <i data-lucide="circle-check" aria-hidden="true"></i>
                    </div>
                    <div class="agenda-row">
                        <span class="agenda-row__date">09</span>
                        <span class="agenda-row__marker agenda-row__marker--warm"></span>
                        <div><strong>Проверить запасы семян</strong><small>Список «Весна»</small></div>
                        <i data-lucide="circle" aria-hidden="true"></i>
                    </div>
                </div>

                <div class="season-board__note">
                    <i data-lucide="notebook-pen" aria-hidden="true"></i>
                    <div><span>Последняя запись в журнале</span><strong>«После дождя почва хорошо держит влагу»</strong></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--line" id="possibilities">
        <div class="shell">
            <div class="section-heading section-heading--split">
                <div>
                    <p class="eyebrow"><span></span> Что уже работает</p>
                    <h2>Весь базовый контекст сезона — рядом</h2>
                </div>
                <p>Не заменяем ваш способ выращивать. Помогаем не терять информацию между грядкой, заметками и календарём.</p>
            </div>

            <div class="feature-grid">
                <article class="feature-card feature-card--wide">
                    <div class="feature-card__icon"><i data-lucide="map" aria-hidden="true"></i></div>
                    <div>
                        <span class="feature-card__meta">Структура</span>
                        <h3>Огороды и растения</h3>
                        <p>Разделяйте участки, добавляйте растения и держите историю каждого сезона в понятной структуре.</p>
                    </div>
                    <div class="feature-card__mini-map" aria-hidden="true">
                        <span></span><span></span><span></span><span></span><span></span><span></span>
                    </div>
                </article>

                <article class="feature-card">
                    <div class="feature-card__icon"><i data-lucide="package-open" aria-hidden="true"></i></div>
                    <span class="feature-card__meta">Коллекция</span>
                    <h3>Списки семян</h3>
                    <p>Храните сорта и запасы в списках, чтобы не собирать коллекцию заново перед каждым сезоном.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-card__icon"><i data-lucide="calendar-days" aria-hidden="true"></i></div>
                    <span class="feature-card__meta">План</span>
                    <h3>Календарь событий</h3>
                    <p>Планируйте собственные работы и важные даты. Рекомендации будут развиваться отдельно после релиза.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-card__icon"><i data-lucide="list-checks" aria-hidden="true"></i></div>
                    <span class="feature-card__meta">Действия</span>
                    <h3>Задачи</h3>
                    <p>Фиксируйте, что нужно сделать. На старших тарифах доступны повторяющиеся задачи.</p>
                </article>

                <article class="feature-card feature-card--journal">
                    <div class="feature-card__icon"><i data-lucide="book-open-text" aria-hidden="true"></i></div>
                    <span class="feature-card__meta">История</span>
                    <h3>Журнал наблюдений</h3>
                    <p>Записывайте работы и наблюдения, чтобы следующий сезон начинался не с догадок, а с собственного опыта.</p>
                    <blockquote>«Когда сеял, что пересаживал, что сработало — всё остаётся рядом с огородом.»</blockquote>
                </article>
            </div>
        </div>
    </section>

    <section class="section plans-section" id="plans">
        <div class="shell">
            <div class="section-heading section-heading--split section-heading--plans">
                <div>
                    <p class="eyebrow"><span></span> Тарифы</p>
                    <h2>Начните бесплатно. Расширяйте лимиты по мере роста.</h2>
                </div>
                <div class="billing-switch" data-billing-switch aria-label="Период оплаты">
                    <button type="button" class="is-active" data-period="monthly">Месяц</button>
                    <button type="button" data-period="yearly">Год</button>
                </div>
            </div>

            <div class="plan-grid">
                @foreach (config('landing.plans') as $plan)
                    <article class="plan-card {{ $plan['featured'] ? 'plan-card--featured' : '' }}">
                        @if ($plan['featured'])
                            <span class="plan-card__badge">Популярный выбор</span>
                        @endif
                        <div class="plan-card__head">
                            <span>{{ $plan['eyebrow'] }}</span>
                            <h3>{{ $plan['name'] }}</h3>
                            <p>{{ $plan['description'] }}</p>
                        </div>
                        <div class="plan-card__price">
                            <strong
                                data-plan-price
                                data-monthly="{{ $plan['monthly'] ?? '' }}"
                                data-yearly="{{ $plan['yearly'] ?? '' }}"
                                data-free="{{ $plan['code'] === 'free' ? 'true' : 'false' }}"
                            >
                                {{ $plan['monthly'] ?: 'Цена настраивается' }}
                            </strong>
                            <span data-plan-period>
                                @if ($plan['code'] === 'free')
                                    {{ $plan['period_note'] }}
                                @elseif ($plan['monthly'])
                                    в месяц
                                @else
                                    будет указана до запуска оплат
                                @endif
                            </span>
                        </div>
                        <ul class="plan-card__features">
                            @foreach ($plan['features'] as $feature)
                                <li><i data-lucide="check" aria-hidden="true"></i><span>{{ $feature }}</span></li>
                            @endforeach
                        </ul>
                        <a class="button {{ $plan['featured'] ? 'button--primary' : 'button--outline' }}" href="{{ config('landing.app_url') }}">
                            {{ $plan['code'] === 'free' ? 'Начать бесплатно' : 'Перейти в приложение' }}
                            <i data-lucide="arrow-right" aria-hidden="true"></i>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="plans-note">
                <i data-lucide="info" aria-hidden="true"></i>
                <p>
                    Оплата платных тарифов оформляется внутри приложения. До подключения production-платежей цены старших тарифов могут отображаться как настраиваемые; перед началом продаж здесь будут опубликованы актуальные суммы и периоды.
                </p>
            </div>
        </div>
    </section>

    <section class="section roadmap-section" id="roadmap">
        <div class="shell roadmap-layout">
            <div class="roadmap-intro">
                <p class="eyebrow"><span></span> Роадмап</p>
                <h2>Сначала надёжная основа. Затем — больше сезонной пользы.</h2>
                <p>Публичный план отражает продуктовые этапы Cropkeeper и намеренно не повторяет внутренний технический backlog.</p>
            </div>

            <div class="roadmap-list">
                @foreach (config('landing.roadmap') as $index => $stage)
                    <article class="roadmap-item {{ $index === 0 ? 'is-current' : '' }}">
                        <div class="roadmap-item__rail">
                            <span class="roadmap-item__dot"></span>
                        </div>
                        <div class="roadmap-item__content">
                            <span class="roadmap-item__status">{{ $stage['status'] }}</span>
                            <h3>{{ $stage['title'] }}</h3>
                            <ul>
                                @foreach ($stage['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section trust-section">
        <div class="shell trust-grid">
            <div class="trust-copy">
                <p class="eyebrow eyebrow--light"><span></span> Перед оплатой всё прозрачно</p>
                <h2>Условия, контакты и документы доступны до покупки.</h2>
                <p>Cropkeeper публикует описание сервиса, тарифы, условия оплаты и обязательные документы на одном публичном сайте.</p>
            </div>
            <div class="trust-links">
                <a href="{{ route('offer') }}">
                    <i data-lucide="file-text" aria-hidden="true"></i>
                    <span><strong>Публичная оферта</strong><small>Условия предоставления доступа и оплаты</small></span>
                    <i data-lucide="arrow-up-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('privacy') }}">
                    <i data-lucide="shield-check" aria-hidden="true"></i>
                    <span><strong>Конфиденциальность</strong><small>Какие данные используем и зачем</small></span>
                    <i data-lucide="arrow-up-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('personal-data') }}">
                    <i data-lucide="user-round-check" aria-hidden="true"></i>
                    <span><strong>Персональные данные</strong><small>Правила и основания обработки</small></span>
                    <i data-lucide="arrow-up-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="section seller-section" aria-labelledby="seller-heading">
        <div class="shell seller-card">
            <div>
                <p class="eyebrow"><span></span> Контакты и реквизиты</p>
                <h2 id="seller-heading">Связаться с Cropkeeper</h2>
                <p>Эти данные будут использоваться для обращений пользователей и юридически значимых сообщений.</p>
            </div>
            <dl class="seller-details">
                <div><dt>Продавец</dt><dd>{{ config('landing.seller.name') }}</dd></div>
                <div><dt>Статус</dt><dd>{{ config('landing.seller.status') }}</dd></div>
                <div><dt>ИНН</dt><dd>{{ config('landing.seller.inn') }}</dd></div>
                <div><dt>ОГРНИП / ОГРН</dt><dd>{{ config('landing.seller.ogrn') }}</dd></div>
                <div><dt>Email</dt><dd>{{ config('landing.seller.email') }}</dd></div>
                <div><dt>Телефон</dt><dd>{{ config('landing.seller.phone') }}</dd></div>
                <div class="seller-details__full"><dt>Адрес</dt><dd>{{ config('landing.seller.address') }}</dd></div>
            </dl>
        </div>
    </section>
@endsection
