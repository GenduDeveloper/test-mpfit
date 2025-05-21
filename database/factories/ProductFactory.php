<?php

namespace Database\Factories;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name'        => $this->faker->sentence(2, false),
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'description' => $this->faker->text(150),
            'price'       => $this->faker->randomFloat(2, 0, 19999.99)
        ];
    }
}
