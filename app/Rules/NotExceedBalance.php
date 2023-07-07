<?php

namespace App\Rules;

use App\Models\Account;
use App\Models\InvestmentAccount;
use Illuminate\Contracts\Validation\Rule;

class NotExceedBalance implements Rule
{
    private int $id;
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function passes($attribute, $value): bool
    {
        $accounts = collect(Account::all())->merge(InvestmentAccount::all());
        $account = $accounts->firstWhere('id', $this->id);

        return $account['balance'] >= $value;
    }

    public function message(): string
    {
        return 'Amount cannot exceed balance';
    }
}
