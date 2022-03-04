<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Webpatser\Countries\Countries;
use Database\Factories\CountryFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    protected $url = 'api/auth';

    /**
     * Error Get Create Client
     *
     * @return void
     */
    public function testErrorGetCreateClient()
    {

        $payload = [
            // 'name' => 'Everton Alves',
            // 'email' => 'ellalvesdev@gmail.com',
            // 'password' => 'ellalvesdev@gmail.com',
        ];

        $response = $this->postJson("{$this->url}/clients", $payload);

        $response->assertStatus(422);
    }

    /**
     * Get Create Client
     *
     * @return void
     */
    public function testGetCreateClient()
    {

        $countryFactory = new CountryFactory();

        Countries::insert($countryFactory->definition());

        $payload = [
            'name' => 'Everton Alves',
            'phone' => '(75) 99189-6668',
            'email' => 'ellalvesdev@gmail.com',
            'password' => 'ellalvesdev@gmail.com',
            'street'       => 'rua, 200',
            'street_extra' => 'bairro',
            'city'         => 'cidade',
            'state'        => 'estado',
            'post_code'    => 'cod-postal',
            'country'      => Countries::first()->iso_3166_2,
            'country_id'   => Countries::first()->id,
        ];

        $response = $this->postJson("{$this->url}/clients", $payload);

        $response->assertStatus(201);
                    // ->assertExactJson([
                    //     'data' => [
                    //         'name' => $payload['name'],
                    //         'email' => $payload['email'],
                    //     ]
                    // ]);
    }
}
