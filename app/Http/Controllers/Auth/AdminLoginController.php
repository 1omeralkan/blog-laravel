<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AdminLoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.admin-login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        // Sadece admin rolü olanlar giriş yapabilsin
        if (auth()->user()->role_id !== 0) {
            Auth::guard('web')->logout();
            return back()->withErrors(['email' => 'Bu giriş sadece adminler içindir.']);
        }
        return redirect()->intended('/admin');
    }
} 