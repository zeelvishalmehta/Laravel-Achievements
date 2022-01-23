<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//use Illuminate\Foundation\Testing\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();
        $this->withoutExceptionHandling();
        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }
    public function setUp() :void
    {
        parent::setUp();

       // Route::enableFilters();
    }
}
