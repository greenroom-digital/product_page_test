<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_product_unauthorized_access_returns_401()
    {
        $validSlug = 'fall-limited-edition-sneakers';
        $response = $this->getJson(route('product.show', ['slug' => $validSlug]));

        $response->assertStatus(401);
    }

    public function test_slug_is_invalid_returns_404()
    {
        // Seed the database
        Artisan::call("db:seed");

        $user = User::first();
        Sanctum::actingAs($user);

        $invalidSlug = 'abcdefg';
        $response = $this->getJson(route('product.show', ['slug' => $invalidSlug]));

        $response->assertStatus(404);
    }

    public function test_slug_is_valid()
    {
        // Seed the database
        Artisan::call("db:seed");

        $user = User::first();
        Sanctum::actingAs($user);
        
        $validSlug = 'fall-limited-edition-sneakers';
        $response = $this->getJson(route('product.show', ['slug' => $validSlug]));

        $response->assertStatus(200);
        $response->assertJsonPath('data.slug', $validSlug);
    }

    
}
