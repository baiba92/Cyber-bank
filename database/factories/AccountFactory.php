<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'number' => $this->faker->iban(),
            'balance' => $this->faker->numberBetween(1, 10000),
            'currency' => $this->faker->currencyCode(),
            'bank' => $this->faker->randomElement(['Swedbank', 'SEB', 'Luminor', 'DNB'])
        ];
    }
}
