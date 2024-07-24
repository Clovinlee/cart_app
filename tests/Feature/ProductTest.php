<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_products_fetch(): void
    {

        Product::factory(1)->create();

        $response = $this->get('/api/v1/products');
        $response->assertStatus(200);
        $this->assertEquals(count($response['data']), 1);
    }
}
