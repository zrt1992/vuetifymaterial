<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:api', 'return-json'])->except(['create', 'login']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = $this->updateToken($request);
            return response()->json([
                'message' => "login sucessfully",
                'token' => $token

            ],200);
        } else {
            return response()->json([
                'message' => 'your credentails are invalid'
            ],401);
        }
        //check if user is login and
    }

    public function updateToken(Request $request)
    {
        $token = Str::random(60);

        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return $token;
    }

    protected function create(Request $request)
    {
        dd(Auth::guard('api')->check());
        $token = Str::random(60);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => $token,
        ]);

        return response(['token' => $token], 200);
    }
}
