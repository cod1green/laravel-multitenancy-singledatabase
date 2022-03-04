<?php

namespace Tests\Feature\Api;

use App\Models\Tenant;
use Carbon\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantTest extends TestCase
{
    use RefreshDatabase;

    protected $url = 'api/v1';

    /**
     * Test Get All Tenants
     *
     * @return void
     */
    public function testGetAllTenants()
    {
        Tenant::factory()->count(10)->create();

        $response = $this->getJson("{$this->url}/tenants");

        $response->assertStatus(200);
    }

        /**
     * Test Error Get Single Tenant
     *
     * @return void
     */
    public function testErrorTestGetTenant()
    {
        $tenant = 'fake_value';

        Tenant::factory()->count(10)->create();

        $response = $this->getJson("{$this->url}/tenants/{$tenant}");

        /// $response->dump();

        $response->assertStatus(400);
    }

    /**
     * Test Get Single Tenant
     *
     * @return void
     */
    public function testGetTenant()
    {
        $tenant = Tenant::factory()->count(10)->create();

        $response = $this->getJson("{$this->url}/tenants/{$tenant->first()->uuid}");

        // $response->dump();

        $response->assertStatus(200);
    }
}
