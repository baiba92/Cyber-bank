<?php

namespace App\Http\Controllers;

use App\Models\CryptoTransaction;
use App\Models\InvestmentAccount;
use App\Rules\ValidOTP;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CryptoTransactionController extends Controller
{
    public function create(Request $request)
    {
        [$id, $currency] = explode(' ', $request->input('cryptocurrency'));

        $responseData = (new CryptocurrencyController())->show($id, $currency);

        return view('cryptoTransactions.create', [
            'cryptocurrency' => $responseData,
            'currency' => $currency,
            'price' => $responseData['price'],
            'total' => 0,
            'accounts' => InvestmentAccount::where('user_id', Auth::user()['id'])->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'one_time_password' => ['required', new ValidOTP]
        ]);

        $request->merge(session('request_data'));

        $account = InvestmentAccount::findOrFail($request->input('account_from'));
        $amount = $request->input('amount');
        $price = $request->input('price');
        $cryptoParts = $amount / $price;

        DB::transaction(function () use ($account, $price, $amount, $cryptoParts, $request) {
            CryptoTransaction::create([
                'account_id' => $account->id,
                'crypto_id' => $request->input('cryptoId'),
                'cryptocurrency' => $request->input('cryptocurrency'),
                'currency' => $request->input('currency'),
                'price' => $price,
                'invest' => $amount,
                'crypto_parts' => round($cryptoParts, 4)
            ]);

            $account->balance -= $amount;
            $account->save();
        });

        return redirect()->action([InvestmentAccountController::class, 'index'])
            ->with('success', 'Payment successful');
    }

    public function edit(Request $request)
    {
        //ddd($request->input());
        return view('cryptoTransactions.edit', [
            'accounts' => InvestmentAccount::where('user_id', Auth::user()['id'])->get(),
            'cryptocurrency' => $request->input('cryptocurrency'),
            'value' => $request->input('value'),
            'currency' => $request->input('currency'),
            'cryptoParts' => $request->input('cryptoParts'),
            'transactionId' => $request->input('transactionId'),
            'price' => $request->input('price')
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'one_time_password' => ['required', new ValidOTP]
        ]);

        $request->merge(session('request_data'));

        $account = InvestmentAccount::findOrFail($request->input('account_to'));
        $account->balance += $request->input('amount');
        $account->save();
        $transaction = CryptoTransaction::findOrFail($request->input('transactionId'));
        $transaction->invest -= $request->input('amount');
        $transaction->crypto_parts -= $request->input('amount') / $request->input('price');
        $transaction->save();

        return redirect()->action([InvestmentAccountController::class, 'index'])
            ->with('success', 'Payment successful');
    }
}
