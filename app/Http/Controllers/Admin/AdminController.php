<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;

class AdminController extends Controller
{
    public function index() {
        
        $users = User::count();
        $categories = Category::count();
        $tasks = Task::count();
        $completedTasks = Task::whereCompleted(true)->count();

        return view('admin.index', compact('users', 'categories', 'tasks', 'completedTasks'));
    }
}
