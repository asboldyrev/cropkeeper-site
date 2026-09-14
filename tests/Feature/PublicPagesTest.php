<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_landing_is_public_and_contains_payment_onboarding_sections(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Cropkeeper')
            ->assertSee('Возможности')
            ->assertSee('Тарифы')
            ->assertSee('Что дальше')
            ->assertSee('Free')
            ->assertSee('Pro')
            ->assertSee('Premium')
            ->assertSee('Пользовательское соглашение')
            ->assertSee('Публичная оферта')
            ->assertSee('Политика обработки персональных данных')
            ->assertSee('Cookies и аналитика');
    }

    public function test_landing_only_advertises_current_core_features_as_available(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Карточки растений')
            ->assertSee('Семена и списки')
            ->assertSee('Календарь')
            ->assertSee('Задачи')
            ->assertSee('Журнал наблюдений')
            ->assertSee('Погода на главном экране')
            ->assertSee('Полноценные повторяющиеся задачи для регулярных работ.')
            ->assertSee('Рекомендации по культурам и сезонным работам по мере наполнения базы.')
            ->assertDontSee('Рекомендации будут развиваться отдельно после релиза.')
            ->assertDontSee('На старших тарифах доступны повторяющиеся задачи.')
            ->assertDontSee('Публичный план отражает продуктовые этапы Cropkeeper')
            ->assertDontSee('До подключения production-платежей');
    }

    public function test_empty_seller_details_are_not_rendered(): void
    {
        config()->set('landing.seller', [
            'name' => null,
            'status' => null,
            'inn' => null,
            'ogrn' => null,
            'address' => null,
            'email' => null,
            'phone' => null,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('Связаться с Cropkeeper')
            ->assertDontSee('footer-label">Связь', false)
            ->assertDontSee('footer-label">Продавец', false);

        $this->get('/agreement')->assertOk()->assertDontSee('11. Сведения о Правообладателе');
        $this->get('/offer')->assertOk()->assertDontSee('10. Сведения о Правообладателе / Исполнителе');
        $this->get('/personal-data')->assertOk()->assertDontSee('13. Сведения об операторе');
    }

    public function test_only_filled_seller_details_are_rendered(): void
    {
        config()->set('landing.seller', [
            'name' => 'ИП Тестовый Продавец',
            'status' => null,
            'inn' => null,
            'ogrn' => null,
            'address' => null,
            'email' => 'support@example.test',
            'phone' => null,
        ]);

        foreach (['/agreement', '/offer', '/personal-data'] as $url) {
            $this->get($url)
                ->assertOk()
                ->assertSee('ИП Тестовый Продавец')
                ->assertSee('support@example.test')
                ->assertDontSee('<dt>Телефон</dt>', false)
                ->assertDontSee('<dt>ИНН</dt>', false)
                ->assertDontSee('<dt>ОГРНИП / ОГРН</dt>', false)
                ->assertDontSee('<dt>Адрес</dt>', false);
        }
    }

    public function test_user_agreement_is_public_and_versioned(): void
    {
        $this->get('/agreement')
            ->assertOk()
            ->assertSee('Пользовательское соглашение')
            ->assertSee('Редакция от 14 сентября 2026 года')
            ->assertDontSee('Архив редакций');
    }

    public function test_offer_contains_final_auto_renewal_and_refund_rules(): void
    {
        $this->get('/offer')
            ->assertOk()
            ->assertSee('Публичная оферта')
            ->assertSee('Редакция от 14 сентября 2026 года')
            ->assertSee('Автопродление выключено по умолчанию')
            ->assertSee('не менее чем за 3 календарных дня')
            ->assertSee('фактически уплаченная стоимость периода')
            ->assertSee('порог 12 часов')
            ->assertSee('округляется вверх до ближайшей копейки')
            ->assertSee('Архив редакций')
            ->assertDontSee('Вопросы возврата денежных средств рассматриваются по обращению Пользователя');
    }

    public function test_legacy_privacy_url_redirects_to_canonical_personal_data_policy(): void
    {
        $this->get('/privacy')
            ->assertStatus(301)
            ->assertRedirect('/personal-data');
    }

    public function test_personal_data_policy_contains_final_data_flows(): void
    {
        $this->get('/personal-data')
            ->assertOk()
            ->assertSee('Политика обработки персональных данных')
            ->assertSee('Редакция от 14 сентября 2026 года')
            ->assertSee('приблизительные координаты')
            ->assertSee('Open-Meteo')
            ->assertSee('48 часов')
            ->assertSee('до 1 года после закрытия')
            ->assertSee('трёхлетний срок')
            ->assertSee('Яндекс Метрика используется только после вашего явного согласия')
            ->assertSee('Архив редакций')
            ->assertDontSee('Рабочий шаблон')
            ->assertDontSee('до production-запуска');
    }

    public function test_cookies_document_is_public_versioned_and_user_facing(): void
    {
        $this->get('/cookies')
            ->assertOk()
            ->assertSee('Cookies и аналитика')
            ->assertSee('Как вы выбираете, разрешать ли аналитику')
            ->assertSee('Вы можете в любой момент снова открыть настройки аналитики')
            ->assertSee('Редакция от 14 сентября 2026 года')
            ->assertDontSee('Архив редакций')
            ->assertDontSee('Перед включением аналитики Cropkeeper должен');
    }

    public function test_metrika_is_not_embedded_in_server_html_before_consent(): void
    {
        config()->set('analytics.metrika.enabled', true);
        config()->set('analytics.metrika.counter_id', 12345678);

        $this->get('/')
            ->assertOk()
            ->assertSee('Помочь улучшать Cropkeeper?')
            ->assertSee('Не разрешать')
            ->assertSee('Разрешить аналитику')
            ->assertSee('Настройки аналитики')
            ->assertSee('data-metrika-id="12345678"', false)
            ->assertDontSee('mc.yandex.ru/metrika/tag.js');
    }

    public function test_analytics_consent_ui_is_not_rendered_without_configured_counter(): void
    {
        config()->set('analytics.metrika.enabled', false);
        config()->set('analytics.metrika.counter_id', null);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('Помочь улучшать Cropkeeper?')
            ->assertDontSee('Настройки аналитики')
            ->assertDontSee('data-analytics-consent', false);
    }

    public function test_archive_indexes_are_public_without_authentication(): void
    {
        foreach (['agreement', 'offer', 'personal-data', 'cookies', 'privacy'] as $document) {
            $this->get("/legal/{$document}/archive")
                ->assertOk()
                ->assertSee('Архив');
        }
    }

    public function test_superseded_offer_and_personal_data_revisions_are_public_and_marked_archived(): void
    {
        foreach ([
            '/legal/offer/archive/2026-09-05' => 'Публичная оферта',
            '/legal/personal-data/archive/2026-09-05' => 'Политика обработки персональных данных',
        ] as $url => $title) {
            $this->get($url)
                ->assertOk()
                ->assertSee($title)
                ->assertSee('Редакция от 5 сентября 2026 года')
                ->assertSee('архивная редакция', false)
                ->assertSee('больше не действует');
        }
    }

    public function test_superseded_privacy_revision_is_public_and_marked_archived(): void
    {
        $this->get('/legal/privacy/archive/2026-09-05')
            ->assertOk()
            ->assertSee('Политика конфиденциальности')
            ->assertSee('Редакция от 5 сентября 2026 года')
            ->assertSee('архивная редакция', false)
            ->assertSee('больше не действует');
    }

    public function test_unknown_legal_document_and_revision_return_not_found(): void
    {
        $this->get('/legal/unknown/archive')->assertNotFound();
        $this->get('/legal/privacy/archive/2099-01-01')->assertNotFound();
    }
}
