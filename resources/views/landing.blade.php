@extends('layouts.site')

@section('title', 'Cropkeeper — порядок в огородном сезоне')
@section('description', 'Cropkeeper помогает вести растения, семена, календарь, задачи и журнал наблюдений в одном месте.')

@section('content')
    <section class="hero">
        <div class="shell hero__grid">
            <div class="hero__copy">
                <p class="eyebrow"><span></span> Личный журнал огородного сезона</p>
                <h1>Не держите сезон в памяти. Соберите его в одном месте.</h1>
                <p class="hero__lead">
                    Cropkeeper помогает вести отдельные посадки, коллекцию семян, календарь, задачи и журнал наблюдений — от первых посевов до сбора урожая.
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
                    <span><i data-lucide="check" aria-hidden="true"></i> Работает в браузере</span>
                    <span><i data-lucide="check" aria-hidden="true"></i> Удобно на телефоне и компьютере</span>
                </div>
            </div>

            <div class="season-board" aria-label="Пример сезонных записей в Cropkeeper">
                <div class="season-board__top">
                    <div>
                        <span class="season-board__caption">Сезон · сентябрь</span>
                        <strong>Мои растения</strong>
                    </div>
                    <span class="season-board__weather" aria-label="Пример погодного контекста">
                        <i data-lucide="cloud-sun" aria-hidden="true"></i> +18°
                    </span>
                </div>

                <div class="season-board__beds">
                    <article class="garden-bed garden-bed--tomato">
                        <div class="garden-bed__icon"><i data-lucide="sprout" aria-hidden="true"></i></div>
                        <div>
                            <span>Томаты</span>
                            <strong>Черри</strong>
                            <small>Плодоношение</small>
                        </div>
                    </article>
                    <article class="garden-bed garden-bed--greens">
                        <div class="garden-bed__icon"><i data-lucide="leaf" aria-hidden="true"></i></div>
                        <div>
                            <span>Базилик</span>
                            <strong>Зелёный</strong>
                            <small>Рост</small>
                        </div>
                    </article>
                    <article class="garden-bed garden-bed--root">
                        <div class="garden-bed__icon"><i data-lucide="carrot" aria-hidden="true"></i></div>
                        <div>
                            <span>Редис</span>
                            <strong>Французский завтрак</strong>
                            <small>Собрано</small>
                        </div>
                    </article>
                </div>

                <div class="season-board__agenda">
                    <div class="season-board__agenda-heading">
                        <span>Ближайшие задачи</span>
                        <span>2 задачи</span>
                    </div>
                    <div class="agenda-row">
                        <span class="agenda-row__date">07</span>
                        <span class="agenda-row__marker"></span>
                        <div><strong>Собрать томаты</strong><small>Томаты · Черри</small></div>
                        <i data-lucide="circle-check" aria-hidden="true"></i>
                    </div>
                    <div class="agenda-row">
                        <span class="agenda-row__date">09</span>
                        <span class="agenda-row__marker agenda-row__marker--warm"></span>
                        <div><strong>Проверить запас семян</strong><small>Список «Весна»</small></div>
                        <i data-lucide="circle" aria-hidden="true"></i>
                    </div>
                </div>

                <div class="season-board__note">
                    <i data-lucide="notebook-pen" aria-hidden="true"></i>
                    <div><span>Последняя запись в журнале</span><strong>«Томаты начали активно созревать после тёплой недели»</strong></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--line" id="possibilities">
        <div class="shell">
            <div class="section-heading section-heading--split">
                <div>
                    <p class="eyebrow"><span></span> Возможности</p>
                    <h2>Отдельное место для каждого типа сезонных записей</h2>
                </div>
                <p>Планируйте дела, фиксируйте результат и сохраняйте данные о посадках и семенах так, чтобы к ним было легко вернуться позже.</p>
            </div>

            <div class="feature-grid">
                <article class="feature-card feature-card--wide">
                    <div class="feature-card__icon"><i data-lucide="sprout" aria-hidden="true"></i></div>
                    <div>
                        <span class="feature-card__meta">Посадки</span>
                        <h3>Карточки растений</h3>
                        <p>Добавляйте отдельные посадки, указывайте культуру и сорт, дату посадки, текущий статус, дату сбора и собственные заметки.</p>
                    </div>
                    <div class="feature-card__mini-map" aria-hidden="true">
                        <span></span><span></span><span></span><span></span><span></span><span></span>
                    </div>
                </article>

                <article class="feature-card">
                    <div class="feature-card__icon"><i data-lucide="package-open" aria-hidden="true"></i></div>
                    <span class="feature-card__meta">Коллекция</span>
                    <h3>Семена и списки</h3>
                    <p>Храните культуры и сорта, количество, дату покупки, срок хранения и заметки. Организуйте семена по своим спискам и быстро находите нужное.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-card__icon"><i data-lucide="calendar-days" aria-hidden="true"></i></div>
                    <span class="feature-card__meta">Даты</span>
                    <h3>Календарь</h3>
                    <p>Сохраняйте собственные события сезона и важные даты, чтобы видеть их в одном календаре вместе с запланированными делами.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-card__icon"><i data-lucide="list-checks" aria-hidden="true"></i></div>
                    <span class="feature-card__meta">Дела</span>
                    <h3>Задачи</h3>
                    <p>Создавайте разовые задачи со сроком и приоритетом, связывайте их с растениями или семенами и отмечайте выполненные.</p>
                </article>

                <article class="feature-card feature-card--journal">
                    <div class="feature-card__icon"><i data-lucide="book-open-text" aria-hidden="true"></i></div>
                    <span class="feature-card__meta">Опыт</span>
                    <h3>Журнал наблюдений</h3>
                    <p>Записывайте рост, результаты ухода, проблемы, урожай и обычные заметки. При необходимости связывайте запись с растением, семенами или событием.</p>
                    <blockquote>Следующий сезон проще планировать, когда прошлый не остался только в памяти.</blockquote>
                </article>

                <article class="feature-card">
                    <div class="feature-card__icon"><i data-lucide="cloud-sun" aria-hidden="true"></i></div>
                    <span class="feature-card__meta">Контекст</span>
                    <h3>Погода на главном экране</h3>
                    <p>Укажите населённый пункт в настройках, чтобы видеть актуальный погодный контекст рядом с растениями и ближайшими задачами.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section plans-section" id="plans">
        <div class="shell">
            <div class="section-heading section-heading--split section-heading--plans">
                <div>
                    <p class="eyebrow"><span></span> Тарифы</p>
                    <h2>Выберите подходящий объём коллекции семян</h2>
                    <p>Основные рабочие разделы доступны на всех тарифах. Платные планы увеличивают лимиты списков и позиций семян.</p>
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
                            <span class="plan-card__badge">Оптимальный</span>
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
                                {{ $plan['monthly'] ?: '—' }}
                            </strong>
                            <span data-plan-period>
                                @if ($plan['code'] === 'free')
                                    {{ $plan['period_note'] }}
                                @elseif ($plan['monthly'])
                                    в месяц
                                @endif
                            </span>
                        </div>
                        <ul class="plan-card__features">
                            @foreach ($plan['features'] as $feature)
                                <li><i data-lucide="check" aria-hidden="true"></i><span>{{ $feature }}</span></li>
                            @endforeach
                        </ul>
                        <a class="button {{ $plan['featured'] ? 'button--primary' : 'button--outline' }}" href="{{ config('landing.app_url') }}">
                            {{ $plan['code'] === 'free' ? 'Начать бесплатно' : 'Выбрать тариф' }}
                            <i data-lucide="arrow-right" aria-hidden="true"></i>
                        </a>
                    </article>
                @endforeach
            </div>

            <div class="plans-note">
                <i data-lucide="shield-check" aria-hidden="true"></i>
                <p>Платная подписка оформляется в приложении. Перед подтверждением оплаты показываются выбранный тариф, период и итоговая стоимость.</p>
            </div>
        </div>
    </section>

    <section class="section roadmap-section" id="roadmap">
        <div class="shell roadmap-layout">
            <div class="roadmap-intro">
                <p class="eyebrow"><span></span> Что дальше</p>
                <h2>Cropkeeper будет расти вместе с реальными сезонными сценариями</h2>
                <p>В первую очередь — инструменты, которые сокращают повторяющуюся ручную работу и помогают сохранять больше полезной истории по сезону.</p>
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
                <p class="eyebrow eyebrow--light"><span></span> Условия использования</p>
                <h2>Тарифы, документы и контакты доступны до оплаты</h2>
                <p>Перед покупкой можно заранее ознакомиться с условиями сервиса, правилами обработки данных и реквизитами продавца.</p>
            </div>
            <div class="trust-links">
                <a href="{{ route('offer') }}">
                    <i data-lucide="file-text" aria-hidden="true"></i>
                    <span><strong>Публичная оферта</strong><small>Условия предоставления доступа и оплаты</small></span>
                    <i data-lucide="arrow-up-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('privacy') }}">
                    <i data-lucide="shield-check" aria-hidden="true"></i>
                    <span><strong>Политика конфиденциальности</strong><small>Как используется информация при работе сервиса</small></span>
                    <i data-lucide="arrow-up-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('personal-data') }}">
                    <i data-lucide="user-round-check" aria-hidden="true"></i>
                    <span><strong>Обработка персональных данных</strong><small>Цели, основания и порядок обработки</small></span>
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
                <p>По вопросам работы сервиса, оплаты и доступа используйте указанные ниже контакты.</p>
            </div>
            <dl class="seller-details">
                <div><dt>Email</dt><dd>{{ config('landing.seller.email') }}</dd></div>
                <div><dt>Телефон</dt><dd>{{ config('landing.seller.phone') }}</dd></div>
                <div><dt>Продавец</dt><dd>{{ config('landing.seller.name') }}</dd></div>
                <div><dt>Статус</dt><dd>{{ config('landing.seller.status') }}</dd></div>
                <div><dt>ИНН</dt><dd>{{ config('landing.seller.inn') }}</dd></div>
                <div><dt>ОГРНИП / ОГРН</dt><dd>{{ config('landing.seller.ogrn') }}</dd></div>
                <div class="seller-details__wide"><dt>Адрес</dt><dd>{{ config('landing.seller.address') }}</dd></div>
            </dl>
        </div>
    </section>
@endsection
