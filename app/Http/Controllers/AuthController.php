<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', only: ['logout']),
            new Middleware('guest', except: ['logout'])
        ];
    }

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
            return redirect()->route('admin.dashboard')->with('success', 'User login successfully');
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
            if ($request->hasFile('avatar')) {
                $avatar = Storage::disk('public')->put('avatars', $request->file('avatar'));
                $user->update([
                    'avatar' => $avatar,
                ]);
            }
            Auth::login($user);
            DB::commit();
            return redirect()->route('admin.dashboard')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'User logout successfully');
    }
}
