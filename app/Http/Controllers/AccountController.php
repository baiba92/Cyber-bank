<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\InvestmentAccount;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index()
    {
        return view('accounts.index', [
            'accounts' => Account::where('user_id', Auth::user()['id'])->get()
        ]);
    }

    public function create()
    {
        return view('accounts.create', [
            'currencies' => CurrencyController::currencies()
        ]);
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'number' => ['required', 'string', 'min:10', 'max:30', Rule::unique('accounts', 'number')],
            'currency' => ['required', 'string', 'size:3'],
            'bank' => ['required', 'string', 'max:255']
        ]);

        $accountIds = iterator_to_array(collect(Account::pluck('id'))->merge(InvestmentAccount::pluck('id'))->sort());

        Account::create([
            'id' => array_pop($accountIds) + 1,
            'user_id' => Auth::user()['id'],
            'number' => $attributes['number'],
            'balance' => 0,
            'currency' => $attributes['currency'],
            'bank' => $attributes['bank']
        ]);

        return redirect('/accounts')->with('success', 'Account added successfully');
    }

    public function delete()
    {
        return view('accounts.delete', [
            'accounts' => Account::where('user_id', Auth::user()['id'])->get()
        ]);
    }

    public function validateDelete(Request $request)
    {
        if ((float)Account::findOrFail($request->input('account'))['balance'] != 0) {
            return redirect()->back()->withInput(['account' => $request->input('account')])->with('balance', 'Only accounts with zero balance can be closed');
        }

        Account::where('id', $request->input('account'))->delete();
        return redirect('/accounts')->with('success', 'Account closed successfully');
    }

    public function destroy(Request $request)
    {
        InvestmentAccount::where('id', $request->input('account_id'))->delete();
        return redirect('/accounts/investment')->with('success', 'Account closed successfully');
    }
}
