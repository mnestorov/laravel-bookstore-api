<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['books'])
            ->latest()
            ->paginate(5);

        return response([
            'users' => UsersResource::collection($users),
            'message' => 'Successfully loading the all users data.'
        ], 200) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response([
            'user' => new UsersResource($user),
            'message' => 'Successfully loading the single user data.'
        ], 200);
    }
}
