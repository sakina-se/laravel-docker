<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => 'Ishladi'
        ]);
    }

    public function create(): \Illuminate\Http\JsonResponse
    {
        $name = \request()->input('name');
        $email = \request()->input('email');
        $password = \request()->input('password');
        $username = \request()->input('username');
        $position = \request()->input('position');
        $gender = \request()->input('gender');
        $phone = \request()->input('phone');

        $user = User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'username' => $username,
            'position' => $position,
            'gender' => $gender,
            'phone' => $phone,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }
}
