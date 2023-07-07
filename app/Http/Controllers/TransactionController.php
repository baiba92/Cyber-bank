<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\InvestmentAccount;
use App\Models\Transaction;
use App\Rules\InDatabase;
use App\Rules\NotExceedBalance;
use App\Rules\NotExceedCryptoAmount;
use App\Rules\ValidOTP;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function create()
    {
        return view('transactions.create', [
            'accounts' => Account::where('user_id', Auth::user()['id'])->get()
        ]);
    }

    public function validateTransaction(Request $request)
    {
        $accountToNumberValidation = $request->has('account_number') ? ['required', new InDatabase] : [];
        $accountToValidation = $request->has('account_to') ? ['required'] : [];
        $accountFromValidation = $request->has('account_from') ? ['required'] : [];
        $amount = $request->has('account_from')
            ? ['required', 'numeric', 'min:1', new NotExceedBalance((int)$request->input('account_from'))]
            : ['required', 'numeric', new NotExceedCryptoAmount((int)$request->input('value'))];

        request()->validate([
            'account_from' => $accountFromValidation,
            'account_number' => $accountToNumberValidation,
            'account_to' => $accountToValidation,
            'amount' => $amount
        ]);

        if (!!strpos($request->header('referer'), '/accounts/investment/deposit')) {
            $accountFrom = Account::findOrFail($request->input('account_from'));
            $accountTo = InvestmentAccount::where('id', $request->input('account_to'))->firstOrFail();
            $description = 'deposit';
            $route = null;
            $action = [InvestmentAccountController::class, 'index'];
            $message = 'Deposit made successful';

        } elseif (!!strpos($request->header('referer'), '/accounts/investment/withdraw')) {
            $accountFrom = InvestmentAccount::findOrFail($request->input('account_from'));
            $accountTo = Account::findOrFail($request->input('account_to'));
            $description = 'withdrawal';
            $route = null;
            $action = [InvestmentAccountController::class, 'index'];
            $message = 'Withdrawal made successful';

        } elseif (!!strpos($request->header('referer'), '/accounts/investment/cryptocurrencies/buy')) {
            $request->session()->flash('request_data', $request->input());
            return redirect('/authenticate');

        } elseif (!!strpos($request->header('referer'), '/accounts/investment/cryptocurrencies/sell')) {
            $request->session()->flash('request_data', $request->input());
            return redirect('/authenticate');

        } else {
            $accountFrom = Account::findOrFail($request->input('account_from'));
            $accountTo = Account::where('number', $request->input('account_number'))->firstOrFail();
            $description = $request->input('description');
            $route = '/accounts';
            $action = null;
            $message = 'Transaction successful';
        }

        $amount = $request->input('amount');

        $convertedAmount = 0;
        if ($accountFrom->currency !== $accountTo->currency) {
            $rateFrom = (new CurrencyController)->rate($accountFrom->currency) ?: 1;
            $rateTo = (new CurrencyController)->rate($accountTo->currency) ?: 1;
            $convertedAmount = ($amount / $rateFrom) * $rateTo;
        }

        $requestData = [
            'account_from' => $accountFrom,
            'account_to' => $accountTo,
            'amount' => $amount,
            'converted_amount' => $convertedAmount,
            'description' => $description,
            'route' => $route,
            'action' => $action,
            'message' => $message
        ];

        $request->session()->flash('request_data', $requestData);

        return redirect('/authenticate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'one_time_password' => ['required', new ValidOTP]
        ]);

        $request->merge(session('request_data'));
        $requestData = $request->input();

        $accountFrom = $requestData['account_from'];
        $accountTo = $requestData['account_to'];
        $amount = $requestData['amount'];
        $convertedAmount = $requestData['converted_amount'];
        $description = $requestData['description'];
        $route = $requestData['route'];
        $action = $requestData['action'];
        $message = $requestData['message'];

        DB::transaction(function () use ($accountFrom, $accountTo, $amount, $convertedAmount, $description) {
            Transaction::create([
                'account_from_id' => $accountFrom->id,
                'account_to_id' => $accountTo->id,
                'amount' => $amount,
                'currency' => $accountFrom->currency,
                'description' => $description
            ]);

            $result = $convertedAmount ?: $amount;

            if ($accountTo->deposit) {
                $accountTo->deposit += $result;
                $accountTo->save();
            }

            if ($accountFrom->withdrawal) {
                if ($accountFrom->withdrawal >= $accountFrom->deposit) {
                    $result *= 0.8;
                }
                if ($accountFrom->withdrawal < $accountFrom->deposit) {
                    if (($accountFrom->withdrawal + $result) >= $accountFrom->deposit) {
                        $taxedPart = (($accountFrom->withdrawal + $result) - $accountFrom->deposit) * 0.8;
                        $untaxedPart = $result - (($accountFrom->withdrawal + $result) - $accountFrom->deposit);
                        $result = $untaxedPart + $taxedPart;
                    }

                }
                $accountFrom->withdrawal += $amount;
                $accountFrom->save();
            }

            $accountFrom->balance -= $amount;
            $accountFrom->save();
            $accountTo->balance += $result;
            $accountTo->save();
        });

        return $action ? redirect()->action($action)->with('success', $message)
            : redirect($route)->with('success', $message);
    }

    public function index(Request $request)
    {
        $accountTransactions = DB::table('transactions')
            ->where('account_from_id', $request->input('chosenAccount'))
            ->join('accounts', 'transactions.account_to_id', '=', 'accounts.id')
            ->join('users', 'accounts.user_id', '=', 'users.id')
            ->select('transactions.*', 'users.name')
            ->get();
        $investmentAccountTransactions = DB::table('transactions')
            ->where('account_from_id', $request->input('chosenAccount'))
            ->join('investment_accounts', 'transactions.account_to_id', '=', 'investment_accounts.id')
            ->join('users', 'investment_accounts.user_id', '=', 'users.id')
            ->select('transactions.*', 'users.name')
            ->get();

        $transactions = collect($accountTransactions)->merge($investmentAccountTransactions);

        $request->session()->flash('account', $request->input('chosenAccount'));

        return view('transactions.index', [
            'accounts' => Account::where('user_id', Auth::user()['id'])->get(),
            'transactions' => $transactions
        ]);
    }
}
