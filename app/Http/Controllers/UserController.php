<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = User::create($request->validated());

        $token = $user->createToken('myappToken')->plainTextToken;

        $response = authResponse($user, $token);


        return response($response, 201);
    }

    public function login(LoginRequest $request)
    {



        if (Auth::guard('web')->attempt($request->validated())) {

            $user = Auth::user();

            $token = $user->createToken('myappToken')->plainTextToken;

            $response = authResponse($user, $token);

            return response($response, 201);
        } else {
            throw ValidationException::withMessages([
                'Error' => ['Invalid credentials'],
            ]);
        }
    }

    public function update(UpdateRequest $request)
    {

        $user = $request->user();

        $user->update($request->validated());

        return success(['message' => 'User details updated successfully.']);
    }

    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        return $users;
    }

}
