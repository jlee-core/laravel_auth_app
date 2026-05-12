<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Todo;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(): View
    {
        $todos = Todo::with('user')
            ->latest()
            ->get();

          
            $users = User::latest()->get();

        return view('admin.dashboard', compact(['todos', 'users']));
    }
}
