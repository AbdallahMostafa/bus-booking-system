<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Create User
     * @param  \App\Http\Requests\CreateUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(CreateUserRequest $request) : JsonResponse
    {
        try {            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Log in a user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function login(Request $request)
    {
        
        try {
            $credentials = $request->only('email', 'password');
            if(!Auth::attempt($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Incorrect email or password'
                ], 401);
            }
            $user = User::where('email', $credentials['email'])->first();
            return response()->json([
                'status' => true,
                'message'=> 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);   
        }
    }

}
