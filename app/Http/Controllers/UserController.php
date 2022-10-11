<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\EmptyContentResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        if(auth()->user()->hasRole('admin')){
            $users = User::paginate(10);
            return new UserCollection(['users'=>$users, 'status'=>200]);
        }
        return new ErrorResource(['message' => 'You dont have a permission to see users','status' => 403]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterRequest $request
//     * @return JsonResource
     */
    public function store(RegisterRequest $request)
    {
        try {
            if (auth()->user()->hasPermissionTo('create user')){
                $user = User::create([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                ]);
                $user->assignRole('user');
                if (config('app.env') === 'local') {
                    $email = 'stepanham777@gmail.com';
                } else{
                    $email = $user->email;
                }
                Mail::to($email)->send(new EmailVerification($user->id));
                return new EmptyContentResource(['status' => 201]);
            }
            return new ErrorResource(['message' => 'You dont have a permission to create users','status' => 403]);

        } catch (\Exception $e) {
            return new ErrorResource(['message' => 'something went wrong','status' => 422]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function show($id): JsonResource
    {
        if (auth()->user()->hasRole('admin') || auth()->id() === $id) {
            $user = User::withoutGlobalScope('emailVerified')->find($id);
            if ($user) {
                $roles = $user->getRoleNames();
                return new UserResource(['user' => $user, 'roles' => $roles, 'status' => 200]);
            }
            return new ErrorResource(['message' => 'undefined user id', 'status' => 404]);
        }

        return new ErrorResource(['message' => 'You dont have a permission to see this user','status' => 403]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function edit($id): JsonResource
    {
        if (auth()->user()->hasRole('admin') || auth()->id() === $id) {
            $user = User::find($id);
            $roles = $user->getRoleNames();
            return new UserResource(['user'=>$user, 'roles'=>$roles, 'status'=>200]);
        }
        return new EmptyContentResource(['status' => 403]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return JsonResource
     */
    public function update(UpdateUserRequest $request, $id): JsonResource
    {
        if (auth()->user()->hasRole('admin') || auth()->id() === $id) {
            $user = User::find($id);
            $email_verified_at = $user->email_verified_at;
            if ($user->email !== $request->input('email')) {
                $email_verified_at=Null;
                Mail::to($request->input('email'))->send(new EmailVerification($id));
                foreach ($user->tokens as $token) {
                    $token->revoke();
                }
            }

            User::where('id',$id)->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'email_verified_at' => $email_verified_at,
            ]);
            return new EmptyContentResource(['status' => 204]);
        }

        return new ErrorResource(['message' => 'You dont have a permission to update users','status' => 403]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResource
     */
    public function destroy(int $id): JsonResource
    {
        if (auth()->user()->hasRole('admin') || auth()->id() === $id) {
            User::destroy($id);
            return new EmptyContentResource(['status' => 204]);
        }
        return new EmptyContentResource(['status' => 403]);
    }
}
