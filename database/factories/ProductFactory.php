<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'category' => $this->faker->word(),
            'sku' => $this->faker->unique()->bothify('SKU-####'),
            'image_url' => $this->faker->imageUrl(640, 480, 'products', true),
            'status' => $this->faker->randomElement(['active', 'inactive', 'discontinued']),
        ];
    }
}
