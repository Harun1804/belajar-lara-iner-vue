<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function loginPage()
    {
        return Inertia::render('Auth/Login');
    }

    public function login(LoginRequest $request)
    {
        DB::beginTransaction();
        try {
            Auth::attempt($request->only(['email', 'password']), $request->validated('remember'));
            $request->session()->regenerate();
            DB::commit();
            return redirect()->route('home')->with('success', 'User login successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function registerPage()
    {
        return Inertia::render('Auth/Register');
    }

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create($request->validated());
            Auth::login($user);
            DB::commit();
            return redirect()->route('home')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
