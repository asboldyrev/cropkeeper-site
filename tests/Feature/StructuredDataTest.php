<?php

namespace Tests\Feature;

use Tests\TestCase;

class StructuredDataTest extends TestCase
{
    public function test_homepage_exposes_supported_website_and_application_structured_data(): void
    {
        config()->set('app.url', 'https://cropkeeper.me');

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('<script type="application/ld+json">', false)
            ->assertSee('"@type":"WebSite"', false)
            ->assertSee('"@type":"SoftwareApplication"', false)
            ->assertSee('"name":"Cropkeeper"', false)
            ->assertSee('"url":"https://cropkeeper.me/"', false)
            ->assertSee('"applicationCategory":"LifestyleApplication"', false)
            ->assertSee('"operatingSystem":"Web"', false)
            ->assertDontSee('"aggregateRating"', false)
            ->assertDontSee('"offers"', false);
    }

    public function test_legal_pages_do_not_emit_homepage_structured_data(): void
    {
        $this->get('/agreement')
            ->assertOk()
            ->assertDontSee('<script type="application/ld+json">', false);
    }
}
