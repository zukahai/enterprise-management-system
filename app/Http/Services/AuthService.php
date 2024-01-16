<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthService
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function login($request) {
        $credentials = $request->only('username', 'password');
        return Auth::attempt($credentials);
    }

    public function register($request) {
        $user = User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'),
        ]);
        return $user;
    }
}