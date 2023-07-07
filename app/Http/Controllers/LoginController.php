<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\ValidationException;

class LoginController extends BaseController
{
    public function create(Request $request)
    {
        if ($request->header('referer') == 'http://127.0.0.1:8000/register') {
            session()->flash('showSlider', 'yes');
        }
        return view('login.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed']
        ]);

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified'
            ]);
        }

        session()->regenerate();

        return redirect('/home')->with('success', 'Welcome back!');
    }

    public function delete()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }

    public function index()
    {
        return view('index');
    }
}
