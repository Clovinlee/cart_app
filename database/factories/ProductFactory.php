<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $f_name = $this->faker->words(2, true);
        $f_description = $this->faker->optional(0.8)->paragraph(2);
        $f_price = $this->faker->numberBetween(10000, 10000000);
        return [
            //
            "name" => $f_name,
            "description" => $f_description,
            "category_id" => Category::factory(),
            "price" => $f_price,
        ];
    }
}
