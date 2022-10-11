<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\EmptyContentResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResource
     */
    public function loginUser(LoginRequest $request): JsonResource
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $token = \auth()->user()->createToken('Login')->accessToken;


            return new UserResource([
                'user'   => auth()->user(),
                'token'  => $token,
                'status' => 200]);

        } else {

            return new ErrorResource(['message' => 'Unverified profile', 'status' => 422]);

        }
    }

    /**
     * @param Request $request
     * @return JsonResource
     */
    public function logout(Request $request): JsonResource
    {
        $accessToken = \auth()->user()->token();
        $token = $request->user()->tokens->find($accessToken);
        $token->revoke();
        return new EmptyContentResource(['status' => 204]);
    }

    /**
     * @param $id
     * @return EmptyContentResource
     */
    public function emailVerified($id): EmptyContentResource
    {
        User::where('id', $id)->withoutGlobalScope('emailVerified')->update(['email_verified_at' => now()]);
        return new EmptyContentResource(['status' => 204]);
    }

    public function register(RegisterRequest $request)
    {

        try {


            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            $user->assignRole('user');
            Mail::to($user->email)->send(new EmailVerification($user->id));
            return new EmptyContentResource(['status' => 201]);

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
