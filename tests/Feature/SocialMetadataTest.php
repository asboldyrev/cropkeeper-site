<?php

namespace Tests\Feature;

use Tests\TestCase;

class SocialMetadataTest extends TestCase
{
    public function test_landing_has_open_graph_and_twitter_metadata(): void
    {
        config()->set('app.url', 'https://cropkeeper.me');

        $this->get('/')
            ->assertOk()
            ->assertSee('<meta property="og:site_name" content="Cropkeeper">', false)
            ->assertSee('<meta property="og:locale" content="ru_RU">', false)
            ->assertSee('<meta property="og:type" content="website">', false)
            ->assertSee('<meta property="og:title" content="Cropkeeper — приложение для огородника и дневник сезона">', false)
            ->assertSee('<meta property="og:description" content="Cropkeeper — приложение для огородника: ведите растения и посадки, семена, задачи, календарь и журнал наблюдений в одном месте.">', false)
            ->assertSee('<meta property="og:url" content="https://cropkeeper.me/">', false)
            ->assertSee('<meta property="og:image" content="https://cropkeeper.me/images/app.png">', false)
            ->assertSee('<meta property="og:image:alt" content="Интерфейс Cropkeeper">', false)
            ->assertSee('<meta name="twitter:card" content="summary_large_image">', false)
            ->assertSee('<meta name="twitter:title" content="Cropkeeper — приложение для огородника и дневник сезона">', false)
            ->assertSee('<meta name="twitter:description" content="Cropkeeper — приложение для огородника: ведите растения и посадки, семена, задачи, календарь и журнал наблюдений в одном месте.">', false)
            ->assertSee('<meta name="twitter:image" content="https://cropkeeper.me/images/app.png">', false);
    }

    public function test_social_metadata_uses_each_pages_canonical_url_and_copy(): void
    {
        config()->set('app.url', 'https://cropkeeper.me');

        $this->get('/agreement?utm_source=test')
            ->assertOk()
            ->assertSee('<meta property="og:title" content="Пользовательское соглашение — Cropkeeper">', false)
            ->assertSee('<meta property="og:description" content="Пользовательское соглашение Cropkeeper: правила использования web-приложения и аккаунта.">', false)
            ->assertSee('<meta property="og:url" content="https://cropkeeper.me/agreement">', false)
            ->assertSee('<meta name="twitter:title" content="Пользовательское соглашение — Cropkeeper">', false)
            ->assertSee('<meta name="twitter:image" content="https://cropkeeper.me/images/app.png">', false);
    }
}
