<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class UserTaskSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Create Regular Users
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        // Create Sample Tasks for Admin
        Task::create([
            'user_id' => $admin->id,
            'title' => 'Review System Architecture',
            'description' => 'Review and update the system architecture documentation',
            'status' => 'in_progress',
            'priority' => 'high',
            'due_date' => now()->addDays(7)
        ]);

        Task::create([
            'user_id' => $admin->id,
            'title' => 'Approve User Requests',
            'description' => 'Review and approve pending user access requests',
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => now()->addDays(3)
        ]);

        // Create Sample Tasks for John
        Task::create([
            'user_id' => $user1->id,
            'title' => 'Complete Project Proposal',
            'description' => 'Finish writing the Q4 project proposal document',
            'status' => 'in_progress',
            'priority' => 'high',
            'due_date' => now()->addDays(5)
        ]);

        Task::create([
            'user_id' => $user1->id,
            'title' => 'Team Meeting Preparation',
            'description' => 'Prepare slides and agenda for the weekly team meeting',
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => now()->addDays(2)
        ]);

        Task::create([
            'user_id' => $user1->id,
            'title' => 'Code Review',
            'description' => 'Review pull requests from the development team',
            'status' => 'completed',
            'priority' => 'low',
            'due_date' => now()->subDays(1)
        ]);

        // Create Sample Tasks for Jane
        Task::create([
            'user_id' => $user2->id,
            'title' => 'Client Presentation',
            'description' => 'Create presentation for client meeting next week',
            'status' => 'pending',
            'priority' => 'high',
            'due_date' => now()->addDays(8)
        ]);

        Task::create([
            'user_id' => $user2->id,
            'title' => 'Update Documentation',
            'description' => 'Update user documentation with new features',
            'status' => 'in_progress',
            'priority' => 'medium',
            'due_date' => now()->addDays(10)
        ]);

        Task::create([
            'user_id' => $user2->id,
            'title' => 'Bug Fixes',
            'description' => 'Fix reported bugs in the dashboard',
            'status' => 'completed',
            'priority' => 'high',
            'due_date' => now()->subDays(3)
        ]);

        $this->command->info('Users and tasks created successfully!');
        $this->command->info('Admin: admin@example.com / password');
        $this->command->info('User 1: john@example.com / password');
        $this->command->info('User 2: jane@example.com / password');
    }
}