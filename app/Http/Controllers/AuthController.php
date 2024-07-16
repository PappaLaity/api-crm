<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ResponseTrait;

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/^[a-z][a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
            'password' => 'required|string|min:4',
            'phone' => 'required',
            'role' => 'required|in:provider,manager,admin',
            'structure_id' => 'required|string',
        ]);
        $user = User::create($validatedData);
        return $this->successResponse(new UserResource($user), "User Successfully created", 201);
    }

    public function login(Request $request)
    {
        $loginUserData = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required'
        ]);
        if ($loginUserData->fails()) {
            return Response(['message' => $loginUserData->errors()], 401);
        }

        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$field => $request->login, 'password' => $request->input('password')])) {
            $user = Auth::user();
            $success = $user->createToken('token')->plainTextToken;
            $data = [
                'user' => $user,
                'token' => $success
            ];
            return $this->successResponse($data, "Connexion reussi", 200);
        }
        return $this->errorResponse('login ou mot de passe incorrect', 401);

//        $user = User::where('email', $loginUserData['email'])->first();
//        if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
//            return response()->json([
//                'message' => 'Invalid Credentials'
//            ], 401);
//        }
//        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
//        return response()->json([
//            'access_token' => $token,
//        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            "message" => "logged out"
        ]);
    }
}
