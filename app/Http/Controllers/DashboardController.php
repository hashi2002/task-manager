<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }

        return $this->userDashboard();
    }

    private function adminDashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_tasks' => Task::count(),
            'pending_tasks' => Task::where('status', 'pending')->count(),
            'completed_tasks' => Task::where('status', 'completed')->count(),
        ];

        $recent_tasks = Task::with('user')->latest()->take(5)->get();

        return view('dashboard.admin', compact('stats', 'recent_tasks'));
    }

    private function userDashboard()
    {
        $stats = [
            'my_tasks' => auth()->user()->tasks()->count(),
            'pending' => auth()->user()->tasks()->where('status', 'pending')->count(),
            'in_progress' => auth()->user()->tasks()->where('status', 'in_progress')->count(),
            'completed' => auth()->user()->tasks()->where('status', 'completed')->count(),
        ];

        $recent_tasks = auth()->user()->tasks()->latest()->take(5)->get();

        return view('dashboard.user', compact('stats', 'recent_tasks'));
    }
}