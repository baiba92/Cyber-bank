<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\InvestmentAccount;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CryptocurrencyController extends Controller
{
    public function index(Request $request)
    {
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?convert=';
        $currency = 'EUR';
        if ($request->input('selectedCurrency')) {
            $currency = $request->input('selectedCurrency');
        }

        $response = Http::withOptions([
            'verify' => false
        ])->withHeaders([
            'Accept' => 'application/json',
            'X-CMC_PRO_API_KEY' => env('CRYPTO_API_KEY')
        ])->get($url . $currency);

        $responseData = $response->json()['data'];

        $cryptocurrencies = [];
        foreach ($responseData as $cryptoCurrency) {
            $cryptocurrencies[] = [
                'id' => $cryptoCurrency['id'],
                'name' => $cryptoCurrency['name'],
                'price' => $cryptoCurrency['quote'][$currency]['price'],
                '1h' => $cryptoCurrency['quote'][$currency]['percent_change_1h'],
                '24h' => $cryptoCurrency['quote'][$currency]['percent_change_24h'],
                '7d' => $cryptoCurrency['quote'][$currency]['percent_change_7d'],
                'marketCap' => $cryptoCurrency['quote'][$currency]['market_cap'],
                'id_cur' => $cryptoCurrency['id'] . ' ' . $currency
            ];
        }

        $request->session()->flash('currency', $request->input('selectedCurrency'));

        return view('cryptocurrencies.index', [
            'cryptocurrencies' => $cryptocurrencies,
            'currencies' => CurrencyController::currencies(),
            'selectedCurrency' => $currency
        ]);
    }

    public function show(int $id, string $currency)
    {
        $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?id={$id}&convert={$currency}";

        $response = Http::withOptions([
            'verify' => false
        ])->withHeaders([
            'Accept' => 'application/json',
            'X-CMC_PRO_API_KEY' => env('CRYPTO_API_KEY')
        ])->get($url);

        $responseData = $response->json()['data'][$id];

        return [
            'id' => $responseData['id'],
            'name' => $responseData['name'],
            'price' => round(($responseData['quote'][$currency]['price']),2),
            '1h' => $responseData['quote'][$currency]['percent_change_1h'],
            '24h' => $responseData['quote'][$currency]['percent_change_24h'],
            '7d' => $responseData['quote'][$currency]['percent_change_7d'],
            'marketCap' => $responseData['quote'][$currency]['market_cap'],
            'id_cur' => $responseData['id'] . ' ' . $currency
        ];
    }
}
