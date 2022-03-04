<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $tenant = Tenant::first();
        $productPath = storage_path("app/public/tenants/{$tenant->uuid}/products");

        if (!File::exists($productPath)) {
            File::makeDirectory($productPath, 0755, true);
        }

        $name = $this->faker->unique()->word();
        $slug = Str::slug($name);
        $image = $this->faker->image($productPath, 600, 800, null, false, true, null, true);

        return [
            'uuid' => $this->faker->uuid(),
            'name' => $name,
            'slug' => $slug,
            'image' => sprintf('tenants/%s/products/%s', $tenant->uuid, Str::of($image)->basename()),
            'quantity' => $this->faker->numberBetween(1, 5),
            'details' => $this->faker->sentence(5),
            'description' => $this->faker->realText(),
            'price' => $this->faker->randomFloat(2, 1, 5),
            'featured' => $this->faker->randomElement([true, false]),
            'tenant_id' => $tenant
        ];
    }
}
