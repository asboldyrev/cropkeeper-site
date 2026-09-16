<?php

namespace Tests\Feature;

use Tests\TestCase;

class FaviconAssetsTest extends TestCase
{
    public function test_shared_layout_references_available_favicon_assets(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('<link rel="icon" href="http://localhost/favicon.svg" type="image/svg+xml">', false)
            ->assertSee('<link rel="icon" href="http://localhost/favicon.ico" sizes="any">', false)
            ->assertSee('<link rel="icon" href="http://localhost/favicon-32x32.png" type="image/png" sizes="32x32">', false)
            ->assertSee('<link rel="apple-touch-icon" href="http://localhost/apple-touch-icon.png" sizes="180x180">', false);

        foreach (['favicon.svg', 'favicon.ico', 'favicon-32x32.png', 'apple-touch-icon.png'] as $asset) {
            $path = public_path($asset);

            $this->assertFileExists($path);
            $this->assertGreaterThan(0, filesize($path));
        }
    }
}
