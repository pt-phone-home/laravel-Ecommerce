<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewLandingPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function landing_page_loads_correctly()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Welcome To Your Online Store');
    }
}