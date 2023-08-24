<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('admin.task.index');
    }

    public function edit(Task $task)
    {

        $users = User::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();

        return view('admin.task.edit', compact('task', 'users', 'categories'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated() + ['user_id' => auth()->id()]);

        return to_route('admin.tasks.index')->with('message', 'Task Updated');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return to_route('admin.tasks.index')->with('message', 'Task Deleted !');
    }
}
