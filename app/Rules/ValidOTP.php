<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use PragmaRX\Google2FA\Google2FA;

class ValidOTP implements Rule
{
    private Google2FA $google2fa;
    public function __construct()
    {
        $this->google2fa = app('pragmarx.google2fa');
    }

    public function passes($attribute, $value)
    {
        return $this->google2fa->verifyKey(auth()->user()->otp_secret, $value);
    }

    public function message()
    {
        return 'The code is not valid';
    }
}
