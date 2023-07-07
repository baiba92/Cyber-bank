<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'account_from_id' => Account::factory(),
            'account_to_id' => Account::factory(),
            'amount' => $this->faker->numberBetween(1, 100),
            'currency' => $this->faker->currencyCode(),
            'description' => $this->faker->word()
        ];
    }
}
