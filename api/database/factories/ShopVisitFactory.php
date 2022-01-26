<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopVisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $shops = Shop::all()->pluck('id')->toArray();

        return [
            'shop_id' => $this->faker->randomElement($shops),
            'created_at' => $this->faker->dateTimeBetween('-4 month'),
        ];
    }
}
