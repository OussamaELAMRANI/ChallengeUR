<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\SignUpClientRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Services\Auth\AuthService;

class AuthController extends Controller
{
    private $user;


    /**
     * Inject AuthService on AuthController
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->user = $authService;
    }

    /**
     * @param SignUpClientRequest $request | (Validate Request content before send it the service)
     * @return string
     */
    public function signUp(SignUpClientRequest $request)
    {
        return $this->user->signUp($request);
    }

    /**
     * @param LoginUserRequest $req | (Validate Request content before send it the service)
     * @return \Illuminate\Http\JsonResponse
     */
    public function SignIn(LoginUserRequest $req)
    {
        return $this->user->logIn($req);
    }


    public function logout(Request $req)
    {
        return $this->user->logout($req);
    }

    /**
     * User Infos (email, name, id ...)
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function infos(Request $req)
    {
        return $this->user->userInfos($req);
    }


}
