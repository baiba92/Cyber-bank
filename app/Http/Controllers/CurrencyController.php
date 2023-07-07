<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function rate(string $currency): ?float
    {
        $url = 'https://www.bank.lv/vk/ecb.xml';

        $response = Http::withOptions([
            'verify' => false
        ])->get($url);

        $rates = simplexml_load_string($response->body());

        foreach ($rates->Currencies->Currency as $record) {
            if ((string)$record->ID === $currency) {
                return (float)$record->Rate;
            }
        }
        return null;
    }

    public static function currencies(): array
    {
        $url = 'https://www.bank.lv/vk/ecb.xml';

        $response = Http::withOptions([
            'verify' => false
        ])
            ->get($url);

        $rates = simplexml_load_string($response->body());

        $currencies = [];
        foreach ($rates->Currencies->Currency as $record) {
            $currencies[] = (string)$record->ID;
        }
        return $currencies;
    }
}
