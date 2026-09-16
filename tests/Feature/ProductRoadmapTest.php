<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductRoadmapTest extends TestCase
{
    public function test_landing_separates_available_and_in_development_product_features(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Уже доступно')
            ->assertSee('Растения и история посадок')
            ->assertSee('Коллекция семян')
            ->assertSee('Задачи по уходу')
            ->assertSee('Календарь садовода')
            ->assertSee('Журнал наблюдений')
            ->assertSee('Погода для вашего огорода')
            ->assertSee('В развитии')
            ->assertSee('Рекомендации по уходу')
            ->assertSee('Лунный календарь')
            ->assertSee('Умный помощник')
            ->assertSee('Карта огорода')
            ->assertSee('Севооборот')
            ->assertSee('Статистика огорода')
            ->assertSee('История погоды')
            ->assertSee('База знаний')
            ->assertSee('Рецепты из урожая')
            ->assertSee('Фотодневник')
            ->assertSee('Совместный огород');
    }

    public function test_roadmap_uses_lucide_icons_instead_of_emoji(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('data-lucide="sprout"', false)
            ->assertSee('data-lucide="lightbulb"', false)
            ->assertSee('data-lucide="moon"', false)
            ->assertSee('data-lucide="bot"', false)
            ->assertSee('data-lucide="map"', false)
            ->assertSee('data-lucide="camera"', false)
            ->assertSee('data-lucide="users"', false);
    }
}
