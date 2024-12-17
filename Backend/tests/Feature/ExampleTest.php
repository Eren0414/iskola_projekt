<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertSee('Laravel');

        $response->assertStatus(200);
    }
    public function test_the_api_returns_a_successful_response(): void
    {
        $response = $this->get('/api');
        //A válasz tartalmazza-e az API szót?
        $response->assertSee('API');
        //A válasz státusza 200-e?
        $response->assertStatus(200);
    }
}
