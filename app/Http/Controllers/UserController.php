<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();
        $roles = User::distinct()->pluck('role');
        return view('admin.manage_users', compact('users', 'roles'));
    }

    public function create()
    {

    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $this->authorize('manage', User::class);

        $validatedData = $request->validate([
            'login' => 'required|string|min:5|max:60|unique:users|regex:/^[a-zA-Z0-9_]+$/',
            'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\-]+$/u',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:60',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return response()->json(['message' => 'Пользователь успешно добавлен']);
    }

    public function show(User $user)
    {

    }

    public function edit(User $user)
    {

    }

    public function update(UpdateUserRequest $request, User $user)
    {

    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(['message' => 'Пользователь успешно удален']);
    }
}
