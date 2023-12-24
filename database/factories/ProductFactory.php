<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Str;
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
    public function definition()
    {
        $name = $this->faker->words(2 , 'true');
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(2),
            'image' => $this->faker->imageUrl(300 , 300),
            'price' => $this->faker->randomFloat(1 , 1 , 999) ,
            'compare_price' => $this->faker->randomFloat(1, 500, 999),
            'category_id'=>Category::inrandomOrder()->first()->id,
            'store_id'=>Store::inrandomOrder()->first()->id,
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'featured' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['active', 'archived', 'draft']),
        ];
    }
}
