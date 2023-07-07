<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CryptocurrencyController;
use App\Http\Controllers\CryptoTransactionController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\InvestmentAccountController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/authenticate', function (Request $request) {

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
})->middleware('auth');

Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/register', [UserController::class, 'store'])->middleware('guest');
Route::get('/profile', [UserController::class, 'index'])->middleware('auth');

Route::get('/home', [LoginController::class, 'index'])->middleware('auth');
Route::get('/', [LoginController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'delete'])->middleware('auth');

Route::get('/accounts', [AccountController::class, 'index'])->middleware('auth');
Route::get('/accounts/add', [AccountController::class, 'create'])->middleware('auth');
Route::post('/accounts', [AccountController::class, 'store'])->middleware('auth');
Route::get('/accounts/delete', [AccountController::class, 'delete'])->middleware('auth');
Route::post('/accounts/validate-delete', [AccountController::class, 'validateDelete'])->middleware('auth');
Route::post('/accounts/delete', [AccountController::class, 'destroy'])->middleware('auth');

Route::get('/accounts/investment', [InvestmentAccountController::class, 'index'])->middleware('auth');
Route::get('/accounts/investment/new', [InvestmentAccountController::class, 'create'])->middleware('auth');
Route::post('/accounts/investment', [InvestmentAccountController::class, 'store'])->middleware('auth');
Route::get('/accounts/investment/deposit', [InvestmentAccountController::class, 'edit'])->middleware('auth');
Route::get('/accounts/investment/withdraw', [InvestmentAccountController::class, 'edit'])->middleware('auth');
Route::get('/accounts/investment/delete', [InvestmentAccountController::class, 'delete'])->middleware('auth');
Route::post('/accounts/investment/validate-delete', [InvestmentAccountController::class, 'validateDelete'])->middleware('auth');
Route::post('/accounts/investment/delete', [InvestmentAccountController::class, 'destroy'])->middleware('auth');

Route::get('/accounts/investment/cryptocurrencies', [CryptocurrencyController::class, 'index'])->middleware('auth');

Route::get('/accounts/investment/cryptocurrencies/owned', [CryptoTransactionController::class, 'index'])->middleware('auth');
Route::get('/accounts/investment/cryptocurrencies/buy', [CryptoTransactionController::class, 'create'])->middleware('auth');
Route::post('/accounts/investment/cryptocurrencies/owned', [CryptoTransactionController::class, 'store'])->middleware('auth');
Route::get('/accounts/investment/cryptocurrencies/sell', [CryptoTransactionController::class, 'edit'])->middleware('auth');
Route::post('/accounts/investment/cryptocurrencies/sell', [CryptoTransactionController::class, 'update'])->middleware('auth');

Route::get('/transaction/history', [TransactionController::class, 'index'])->middleware('auth');
Route::get('/transaction', [TransactionController::class, 'create'])->middleware('auth');
Route::post('/validate', [TransactionController::class, 'validateTransaction'])->middleware('auth');
Route::post('/transaction', [TransactionController::class, 'store'])->middleware('auth');

Route::get('/rates', [CurrencyController::class, 'rate'])->middleware('auth');
