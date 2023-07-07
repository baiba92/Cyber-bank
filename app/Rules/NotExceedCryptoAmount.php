<?php

namespace App\Rules;

use App\Models\Account;
use App\Models\InvestmentAccount;
use Illuminate\Contracts\Validation\Rule;

class NotExceedCryptoAmount implements Rule
{
    private float $value;
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function passes($attribute, $value): bool
    {
        return $this->value >= $value;
    }

    public function message(): string
    {
        return 'Cash-out amount cannot exceed available amount';
    }
}
