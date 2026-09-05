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
            ->assertSee('Роадмап')
            ->assertSee('Контакты и реквизиты')
            ->assertSee('Free')
            ->assertSee('Pro')
            ->assertSee('Premium')
            ->assertSee('Публичная оферта')
            ->assertSee('Политика конфиденциальности')
            ->assertSee('Политика обработки персональных данных');
    }

    public function test_recommendations_are_positioned_as_post_release_work(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Рекомендации будут развиваться отдельно после релиза.')
            ->assertSee('Наполнение и постепенное включение рекомендаций по культурам и сезонным работам.');
    }

    public function test_offer_is_public(): void
    {
        $this->get('/offer')
            ->assertOk()
            ->assertSee('Публичная оферта')
            ->assertSee('Стоимость и порядок оплаты')
            ->assertSee('Автоматическое продление');
    }

    public function test_privacy_policy_is_public(): void
    {
        $this->get('/privacy')
            ->assertOk()
            ->assertSee('Политика конфиденциальности')
            ->assertSee('Какие данные могут использоваться');
    }

    public function test_personal_data_policy_is_public(): void
    {
        $this->get('/personal-data')
            ->assertOk()
            ->assertSee('Политика обработки персональных данных')
            ->assertSee('Цели и правовые основания обработки');
    }
}
