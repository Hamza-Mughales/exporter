<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $product  = Product::inRandomOrder()->first();
        $quantity = $this->faker->numberBetween(1, 10);

        return [
            'company_id'  => $product->company_id,
            'product_id'  => $product->id,
            'quantity'    => $quantity,
            'total_price' => $product->price * $quantity,
        ];
    }
}
