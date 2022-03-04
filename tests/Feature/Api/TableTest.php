<?php

namespace Tests\Feature\Api;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    use RefreshDatabase;

    protected $url = 'api/v1/tenants';

    /**
     * Error Get Tables By Tenant.
     *
     * @return void
     */
    public function testErrorGetTablesByTenant()
    {
        $tenant = 'Fake_value';

        $response = $this->getJson("{$this->url}/tenants/{$tenant}/tables");

        $response->assertStatus(404);
    }

    /**
     * Get Tables By Tenant.
     *
     * @return void
     */
    public function testGetTablesByTenant()
    {
        $tenant = Tenant::factory()->create();
        
        $response = $this->getJson("{$this->url}/{$tenant->uuid}/tables");

        $response->assertStatus(200);
    }

    /**
     * Error Get Table By Tenant.
     *
     * @return void
     */
    public function testErrorGetTableByTenant()
    {
        $tenant = Tenant::factory()->create();

        $table = 'Fake_value';
        
        $response = $this->getJson("{$this->url}/{$tenant->uuid}/tables/{$table}");

        $response->assertStatus(400);
    }

    /**
     * Get Table By Tenant.
     *
     * @return void
     */
    public function testGetTableByTenant()
    {
        $tenant = Tenant::factory()
                        ->has(Table::factory()->count(1))
                        ->create();

        $table = $tenant->tables()->first()->uuid;
        
        $response = $this->getJson("{$this->url}/{$tenant->uuid}/tables/{$table}");

        $response->assertStatus(200);
    }
}
