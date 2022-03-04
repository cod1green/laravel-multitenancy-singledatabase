<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Client;
use Illuminate\Support\Str;
use Webpatser\Countries\Countries;
use Database\Factories\AddressFactory;
use Database\Factories\CountryFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    protected $url = 'api/v1';

    /**
     * Error Get Address By Client
     *
     * @return void
     */
    public function testErrorGetAddressByClient()
    {
        $uuidAddress = 'value_fake';

        $client = Client::factory()->create();

        $countryFactory = new CountryFactory();

        $addressFactory = new AddressFactory();

        Countries::insert($countryFactory->definition());

        $address = $client->addAddress($addressFactory->definition());

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $header = [
            'Authentication' => `Bearer {$token}`
        ];

        $response = $this->getJson("{$this->url}/addresses/{$uuidAddress}/show", $header);

        // $response->dump();

        $response->assertStatus(404);
    }

    /**
     * Get Address By Client
     *
     * @return void
     */
    public function testGetAddressByClient()
    {
        $countryFactory = new CountryFactory();
        Countries::insert($countryFactory->definition());

        $client = Client::factory()->create();
        $addressFactory = new AddressFactory();
        $address = $client->addAddress($addressFactory->definition());

        $uuidAddress = $address->uuid;

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $header = [
            'Authorization' => "Bearer {$token}"
        ];

        $response = $this->getJson("{$this->url}/addresses/{$uuidAddress}", $header);

        // $response->dump();

        $response->assertStatus(200);
    }

    /**
     * Error Create Address For Client
     *
     * @return void
     */
    public function testErrorCreateAddressForClient()
    {
        $countryFactory = new CountryFactory();
        Countries::insert($countryFactory->definition());

        $client = Client::factory()->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $headers = [
            'Authorization' => "Bearer {$token}"
        ];

        $payload = [
            // "street" => "Rua rubens F Dias, 2000",
            // "city" => "Fsa",
            // "state" => "Bahia",
            // "post_code" => "44059-370",
            // "country" => "BR",
            // "country_id" => 1
        ];

        $response = $this->postJson("{$this->url}/addresses", $payload, $headers);

        $response->assertStatus(422);
    }

    /**
     * Create Address For Client
     *
     * @return void
     */
    public function testCreateAddressForClient()
    {
        $countryFactory = new CountryFactory();
        Countries::insert($countryFactory->definition());

        $client = Client::factory()->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $headers = [
            'Authorization' => "Bearer {$token}"
        ];

        $payload = [
            "street" => "Rua rubens F Dias, 2000",
            "street_extra" => "Papagaio",
            "city" => "Fsa",
            "state" => "Bahia",
            "post_code" => "44059-370",
            "country" => "BR",
            "country_id" => 1,
            "is_primary" => 1
        ];

        $response = $this->postJson("{$this->url}/addresses", $payload, $headers);

        // $response->dump();

        $response->assertStatus(201)->assertJsonStructure(['data']);
    }
}
