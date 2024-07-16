<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTrait;

    // HasApiTokens;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $this->successResponse(UserResource::collection($users), "User List");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/^[a-z][a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
            'password' => 'required|string|min:4',
            'phone' => 'required',
            'role' => 'required|in:provider,manager,admin',
            'structure_id' => 'required|string',
        ]);
        try {
            $user = User::create($validatedData);
            return $this->successResponse(new UserResource($user), "User Successfully created", 201);
        } catch (QueryException $e) {
            return $this->errorResponse($e->errorInfo[2], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->successResponse(new UserResource($user), "Details User");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate Data
        // Can just modify Name//email//and phoneNumber
        $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|regex:/^[a-z][a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
                'phone' => 'sometimes',
            ]
        );
        $user->update($validatedData);
        return $this->successResponse(new UserResource($user), "User successfully updated");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->successResponse(null, 'User successfully deleted');

    }

    // Make Function to update password or reset password
}
