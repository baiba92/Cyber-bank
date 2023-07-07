<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\CryptoTransaction;
use App\Models\InvestmentAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class InvestmentAccountController extends Controller
{
    public function index()
    {
        $accounts = InvestmentAccount::where('user_id', Auth::user()['id'])->get();
        $accountIds = [];
        foreach ($accounts as $account) {
            $accountIds[] = $account->id;
        }
        $transactions = CryptoTransaction::select('*')->whereIn('account_id', $accountIds)->get();

        $cryptocurrencies = [];
        foreach ($transactions as $transaction) {
            $currency = (new CryptocurrencyController())
                ->show($transaction->crypto_id, $transaction->currency);
            if (!in_array($currency, $cryptocurrencies)) {
                $cryptocurrencies[] = $currency;
            }
        }

        return view('investmentAccounts.index', [
            'accounts' => $accounts,
            'cryptoTransactions' => $transactions,
            'cryptocurrencies' => $cryptocurrencies
        ]);
    }

    public function create()
    {
        $accounts = Account::where('user_id', Auth::user()['id'])->get();
        $banks = [];
        foreach ($accounts as $account) {
            $banks[] = $account->bank;
        }

        return view('investmentAccounts.create', [
            'currencies' => CurrencyController::currencies(),
            'banks' => $banks
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => ['string', 'max:255'],
            'currency' => ['required'],
            'bank' => ['required']
        ]);

        $permittedChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $permittedDigits = '0123456789';

        $accountIds = iterator_to_array(collect(Account::pluck('id'))->merge(InvestmentAccount::pluck('id'))->sort());

        InvestmentAccount::create([
            'id' => array_pop($accountIds) + 1,
            'user_id' => Auth::user()['id'],
            'title' => $attributes['title'],
            'number' => substr(str_shuffle($permittedChars), 0, 4)
                . substr(str_shuffle($permittedDigits), 0)
                . substr(str_shuffle($permittedDigits), 0, 6),
            'bank' => $attributes['bank'],
            'currency' => $attributes['currency'],
            'deposit' => 0,
            'balance' => 0,
            'withdrawal' => 0
        ]);

        return redirect('/accounts/investment')->with('success', 'Account created successfully');
    }

    public function edit(Request $request)
    {
        $viewName = 'investmentAccounts.edit.withdraw';

        if ($request->path() == 'accounts/investment/deposit') {
            $viewName = 'investmentAccounts.edit.deposit';
        }

        return view($viewName, [
            'accounts' => Account::where('user_id', Auth::user()['id'])->get(),
            'investmentAccounts' => InvestmentAccount::where('user_id', Auth::user()['id'])->get(),
            'account_from' => $request->input('account_from') ?: null,
            'account_to' => $request->input('account_to')?: null
        ]);
    }

    public function update(Request $request)
    {

    }

    public function delete()
    {
        return view('investmentAccounts.delete', [
            'investmentAccounts' => InvestmentAccount::where('user_id', Auth::user()['id'])->get()
        ]);
    }

    public function validateDelete(Request $request)
    {
        if ((float)InvestmentAccount::findOrFail($request->input('account'))['balance'] != 0) {
            return redirect()->back()->withInput(['account' => $request->input('account')])->with('balance', 'Only accounts with zero balance can be closed');
        }

        InvestmentAccount::where('id', $request->input('account'))->delete();
        return redirect('/accounts/investment')->with('success', 'Account closed successfully');
    }

    public function destroy(Request $request)
    {
        InvestmentAccount::where('id', $request->input('account_id'))->delete();
        return redirect('/accounts/investment')->with('success', 'Account closed successfully');
    }
}
