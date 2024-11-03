<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    //to sign up -both admin /user
    public function signUp(SignUpRequest $request)
    {
        $signUpData = $request->all();
        // dd($signUpData['user_type']);
        try {
            $user = User::create([
                'name' => $signUpData['name'],
                'email' => $signUpData['email'],
                'password' => bcrypt($signUpData['password']),
                'user_type' => $signUpData['user_type'] ?? 'customer',
            ]);

            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user,
            ], 201);

        } catch (Exception $ex) {
            return response()->json([
                'message' => 'User registeration  unsuccessfull',
                'error' => $ex->getMessage(),
            ], 500);
        }
    }

    //to login - user/admin
    public function login(LoginRequest $request)
    {
        $loginData = $request->only(['email', 'password']); //as it is obj of req cant use req([],[]) ,instead use ->only
        try {
            if (! $token = auth()->attempt($loginData)) {
                return response()->json(['error' => 'Either email or password entered is wrong'], 401);
            }

            return $this->respondWithToken($token);

        } catch (Exception $ex) {
            return response()->json([
                'message' => 'User login failed',
                'error' => $ex->getMessage(),
            ], 500);
        }
    }

    public function logout(): Returntype
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }

    //generate jwt
    /**
     * Get the token array structure.
     *
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
