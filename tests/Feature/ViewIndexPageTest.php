<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewIndexPageTest extends TestCase
{
    public function index_page_loads_correctly() {

        // Arrange


        // Act
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200);
        $response->assertSee('Welcome To Your Online Store');
    }
}
