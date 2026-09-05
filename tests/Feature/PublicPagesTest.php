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
            ->assertSee('Контакты и реквизиты')
            ->assertSee('Free')
            ->assertSee('Pro')
            ->assertSee('Premium')
            ->assertSee('Публичная оферта')
            ->assertSee('Политика конфиденциальности')
            ->assertSee('Обработка персональных данных');
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

    public function test_offer_is_public(): void
    {
        $this->get('/offer')
            ->assertOk()
            ->assertSee('Публичная оферта')
            ->assertSee('Стоимость и порядок оплаты')
            ->assertSee('Автоматическое продление')
            ->assertDontSee('Перед публикацией замените');
    }

    public function test_privacy_policy_is_public(): void
    {
        $this->get('/privacy')
            ->assertOk()
            ->assertSee('Политика конфиденциальности')
            ->assertSee('Какие данные могут использоваться')
            ->assertDontSee('рабочая версия документа')
            ->assertDontSee('До production-запуска');
    }

    public function test_personal_data_policy_is_public(): void
    {
        $this->get('/personal-data')
            ->assertOk()
            ->assertSee('Политика обработки персональных данных')
            ->assertSee('Цели и правовые основания обработки')
            ->assertDontSee('Рабочий шаблон')
            ->assertDontSee('до production-запуска');
    }
}
