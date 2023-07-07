<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->reflash();
        $google2fa = (new Google2FA());
        $qrCodeUrl = $google2fa->getQRCodeInline(
            'name', 'e-mail',
            auth()->user()->otp_secret
        );
        $path = '/transaction';
        if (!!strpos($request->header('referer'), '/accounts/investment/cryptocurrencies/buy')) {
            $path = '/accounts/investment/cryptocurrencies/owned';
        }
        if (!!strpos($request->header('referer'), '/accounts/investment/cryptocurrencies/sell')) {
            $path = '/accounts/investment/cryptocurrencies/sell';
        }

        return view('authenticate', [
            'qrCode' => $qrCodeUrl,
            'secret' => auth()->user()->otp_secret,
            'path' => $path
        ]);
    }
}
