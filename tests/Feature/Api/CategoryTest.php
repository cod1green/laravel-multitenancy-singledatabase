<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
   use RefreshDatabase;

    protected $url = 'api/v1';

    /**
     * Error Get Categories By Tenant
     *
     * @return void
     */
    public function testErrorGetCategoriesByTenant()
    {
        $tenant = 'value_fake';

        $category = Category::factory()->create();

        $response = $this->get("{$this->url}/tenants/{$tenant}/categories");

        $response->assertStatus(400);
    }

    /**
     * Get Categories By Tenant
     *
     * @return void
     */
    public function testGetCategoriesByTenant()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->get("{$this->url}/tenants/{$tenant->uuid}/categories");

        $response->assertStatus(200);
    }

    /**
     * Error Get Category By Tenant
     *
     * @return void
     */
    public function testErrorCategoryByTenant()
    {
        $tenant = Tenant::factory()
                        ->has(Category::factory()->count(1))
                        ->create();

        // $category = $tenant->categories()->first();

        $category = 'fake_value';

        $response = $this->get("{$this->url}/tenants/{$tenant->uuid}/categories/{$category}");

        $response->assertStatus(400);
    }

    /**
     * Get Category By Tenant
     *
     * @return void
     */
    public function testGetCategoryByTenant()
    {
        $tenant = Tenant::factory()
                        ->has(Category::factory()->count(1))
                        ->create();

        $category = $tenant->categories()->first();

        $response = $this->get("{$this->url}/tenants/{$tenant->uuid}/categories/{$category->url}");

        $response->assertStatus(200);
    }
}
