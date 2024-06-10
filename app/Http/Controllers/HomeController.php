<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return Inertia::render('Home', compact('users'));
    }

    public function about()
    {
        return Inertia::render('About');
    }
}
