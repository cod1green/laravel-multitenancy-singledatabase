<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $tenant = Tenant::first();
        $gender = $this->faker->randomElements(["M", "F"])[0];

        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->firstName($gender) . ' ' . $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'sex' => $gender,
            'document' => $this->faker->cpf(false),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify('(##)#####-####'),
            'birth' => $this->faker->dateTimeBetween('-90 years', 'now', 'America/Sao_Paulo'),
            'bio' => $this->faker->realText(),
            'email_verified_at' => now(),
            'password' => '123456',
            'remember_token' => Str::random(10),
            'active' => $this->faker->randomElement([true, false]),
            'tenant_id' => $tenant ?? Tenant::factory()->create()
        ];
    }
}
