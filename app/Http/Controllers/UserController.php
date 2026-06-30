<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

//MODELS
use App\Models\User;

//REQUESTS
use App\Http\Requests\UserEditRequest;

//SERVICES
use App\Services\UserService;

//RESOURCES
use App\Http\Resources\UserEditResource;

class UserController extends Controller
{
    //get user info for editing page
    public function edit(User $user) {
        
        return view('profile_edit', ['user' => $user]);
    }

    //edit user info
    public function update(User $user, UserEditRequest $request, UserService $service) {
        //check data
        $validated = $request->validated();

        //update
        $user = $service->updateUserProfile($user, $validated);

        //inform
        return response()->json([
            'status' => 'ok',
            'msg' => new UserEditResource($user)
        ], 200);
    }
}
