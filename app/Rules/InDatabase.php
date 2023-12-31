<?php

namespace App\Rules;

use App\Http\Middleware\Authenticate;
use App\Models\Account;
use App\Models\InvestmentAccount;
use Illuminate\Contracts\Validation\Rule;

class InDatabase implements Rule
{
    public function passes($attribute, $value): bool
    {
        $allAccounts = collect(Account::pluck('number'))->merge(InvestmentAccount::pluck('number'));
        return $allAccounts->contains($value);
    }

    public function message(): string
    {
        return 'Account with such number was not found';
    }
}
