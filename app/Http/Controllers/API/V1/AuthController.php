<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    /**
     * Login api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->get("email"), 'password' => $request->get("password")])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['id'] =  $user->id;
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Incorrect email or password.',[],401);
        }

    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        return $this->sendResponse([], 'Successfully logged out.');
    }

    public function unauthorized(): JsonResponse
    {
        return $this->sendError('Unauthorized',[],401);
    }
}
