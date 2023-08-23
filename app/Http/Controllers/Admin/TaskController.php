<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('admin.task.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return to_route('admin.categories.index')->with('message', 'Category Deleted !');
    }
}
