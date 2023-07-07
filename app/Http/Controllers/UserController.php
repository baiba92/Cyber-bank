<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use PragmaRX\Google2FAQRCode\Google2FA;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function create(Request $request)
    {
        if ($request->header('referer') == 'http://127.0.0.1:8000/') {
            session()->flash('showSlider', 'yesss');
        }
        return view('users.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'phone' => ['required', 'digits_between:5,25', 'max:255', Rule::unique('users', 'phone')],
            'address' => ['required', 'regex:/^[-,a-zA-Z0-9 ]*$/', 'max:255'],
            'password' => ['required', 'confirmed', 'regex:/^(?=.*[0-9])(?=.*[a-zA-Z]).+$/', 'min:8', 'max:255']
            // regex to match at least one digit and one letter, no spaces and special chars
            // add this for special chars --> (?=.*[-+_!@#$%^&*., ?])
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'user_number' => random_int(10000000, 99999999), // if username, unique:users,username -> db table and column names
            'password' => bcrypt($attributes['password']),
            'email' => $attributes['email'],
            'phone' => $attributes['phone'],
            'address' => $attributes['address'],
            'otp_secret' => (new \PragmaRX\Google2FA\Google2FA())->generateSecretKey()
        ]);

        auth()->login($user);

        return redirect('/profile')->with('success', 'Registration successful');
    }

    public function index()
    {
        $google2fa = (new Google2FA());
        $qrCodeUrl = $google2fa->getQRCodeInline(
            auth()->user()->name, auth()->user()->email,
            auth()->user()->otp_secret
        );

        return view('users.index', [
            'user' => Auth::user(),
            'qrCode' => $qrCodeUrl
        ]);
    }
}
