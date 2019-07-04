<?php


namespace App\Services\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    /**
     * Create new user
     * @param Request $req
     * @return string message
     */
    public function signUp(Request $req)
    {
        $newUser = $req->only(['name', 'email', 'password', 'address', 'lat', 'lng']);

        User::create($newUser);
        return $this->response(['message' => 'Successful added !'], 201);
    }

    public function logIn(Request $req)
    {
        $credentials = $req->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $token = $this->generateToken($req);
            return $this->response($token, 200);
        }

        return $this->response(['error' => 'Unauthorized'], 401);
    }

    /**
     * Logout user (Revoke the token)
     * @param \Illuminate\Http\Request $request
     * @return string message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->response(['message' => 'Successfully logged out'], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfos(Request $request)
    {
        $user = $request->user();
        return $this->response([$user], 200);
    }


    // Generate Token
    public function generateToken(Request $req)
    {
        // Generate a Token
        $user = $req->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        // Increase the duration of our token
        if ($req->input('remember_me')) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();

        return [
            'access_token' => $tokenResult->accessToken,
            'user' => $user,
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ];
    }

    /**
     *
     * @param array $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $message, int $status)
    {
        return response()->json($message, $status);
    }
}
