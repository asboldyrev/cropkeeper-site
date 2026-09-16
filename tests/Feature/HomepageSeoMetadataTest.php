<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageSeoMetadataTest extends TestCase
{
    public function test_homepage_uses_targeted_title_description_and_keywords(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('<title>Cropkeeper — приложение для огородника и дневник сезона</title>', false)
            ->assertSee('<meta name="description" content="Cropkeeper — приложение для огородника: ведите растения и посадки, семена, задачи, календарь и журнал наблюдений в одном месте.">', false)
            ->assertSee('<meta name="keywords" content="приложение для огородника, дневник огородника, журнал огородника, учет растений, учет семян, планирование огородного сезона">', false);
    }

    public function test_legal_pages_do_not_inherit_homepage_keywords(): void
    {
        $this->get('/agreement')
            ->assertOk()
            ->assertDontSee('<meta name="keywords"', false);
    }
}
