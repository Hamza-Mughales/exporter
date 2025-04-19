<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'company_id'  => Company::inRandomOrder()->first()->id,
            'name'        => $this->faker->word,
            'description' => $this->faker->sentence(6),
            'price'       => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
