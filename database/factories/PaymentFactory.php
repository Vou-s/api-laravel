<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'amount' => $this->faker->numberBetween(50000, 2000000),
            'status' => $this->faker->randomElement(['pending', 'paid', 'failed']),
            'payment_method' => $this->faker->randomElement(['bank_transfer', 'credit_card', 'ewallet']),
            'transaction_id' => $this->faker->uuid(),
        ];
    }
}
