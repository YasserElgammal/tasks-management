<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->orderBy('id', 'desc')->paginate(15);
        
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.user.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $validated_data = $request->validated();

        $validated_data['password'] = Hash::make($request->password);

        User::create($validated_data);

        return to_route('admin.user.index')->with('message', 'User Created !');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return to_route('admin.user.index')->with('message', 'User Deleted !');
    }
}
