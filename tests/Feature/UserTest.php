<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Tests\Helpers\UserHelpers;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions, UserHelpers;

    /**
     * @return void
     */
    public function test_show_all_users_admin_success()
    {
        $admin = $this->createUserAndAuthenticate();
        createRolesAndPermissions();
        $admin->assignRole('admin');

        $controller = App::make(UserController::class);

        $response = $controller->index();

        $this->assertEquals(200, $response['status']->resource);
    }

    /**
     * @return void
     */
    public function test_show_all_users_user_fail()
    {
        $this->createUserAndAuthenticate();
        createRolesAndPermissions();
        $controller = App::make(UserController::class);

        $response = $controller->index();
        $this->assertEquals(403, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_show_user_data_admin_success()
    {
        $admin = $this->createUserAndAuthenticate();
        createRolesAndPermissions();
        $admin->assignRole('admin');

        $user = $this->createUser();

        $controller = App::make(UserController::class);

        $response = $controller->show($user->id);

        $this->assertEquals(200, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_show_user_self_data_success()
    {

        createRolesAndPermissions();

        $user = $this->createUserAndAuthenticate();

        $controller = App::make(UserController::class);

        $response = $controller->show($user->id);

        $this->assertEquals(200, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_show_user_data_other_user_fail()
    {
        $this->createUserAndAuthenticate();

        createRolesAndPermissions();

        $user = $this->createUser();

        $controller = App::make(UserController::class);

        $response = $controller->show($user->id);

        $this->assertEquals(403, $response->resource['status']);

    }

    /**
     * @return void
     */
    public function test_admin_creating_user_success()
    {
        $admin = $this->createUserAndAuthenticate();
        createRolesAndPermissions();
        $admin->assignRole('admin');

        $controller = App::make(UserController::class);

        $request = new RegisterRequest([
            "first_name" => "testName",
            "last_name" => "testLastname",
            "email" => Str::random(10)."@gmail.com",
            "password" => '123456789',
            "passwordConfirm" => '123456789',
            "email_verified_at" => "2022-05-19T13:55:08.000000Z",
        ]);
        $response = $controller->store($request);
        $this->assertEquals(201, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_user_creating_user_fail()
    {
        $this->createUserAndAuthenticate();
        createRolesAndPermissions();

        $controller = App::make(UserController::class);

        $request = new RegisterRequest([
            "first_name" => "testName",
            "last_name" => "testLastname",
            "email" => Str::random(10)."@gmail.com",
            "password" => '123456789',
            "passwordConfirm" => '123456789',
            "email_verified_at" => "2022-05-19T13:55:08.000000Z",
        ]);
        $response = $controller->store($request);

        $this->assertEquals(403, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_edit_user_admin_success() {

        createRolesAndPermissions();

        $admin = $this->createUserAndAuthenticate();
        $admin->assignRole('admin');

        $user = $this->createUser();

        $controller = App::make(UserController::class);

        $response = $controller->edit($user->id);
        $this->assertEquals(200, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_edit_user_self_data_success() {

        createRolesAndPermissions();

        $user = $this->createUserAndAuthenticate();

        $controller = App::make(UserController::class);

        $response = $controller->edit($user->id);
        $this->assertEquals(200, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_edit_user_other_user_data_fail() {

        $this->createUserAndAuthenticate();
        createRolesAndPermissions();

        $user = $this->createUser();

        $controller = App::make(UserController::class);

        $response = $controller->edit($user->id);
        $this->assertEquals(403, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_update_user_admin_success() {

        createRolesAndPermissions();

        $admin = $this->createUserAndAuthenticate();
        $admin->assignRole('admin');

        $user = $this->createUser();

        $controller = App::make(UserController::class);

        $request = new UpdateUserRequest ([
            "first_name" => "testName",
            "last_name" => "testLastname",
            "email" => Str::random(10)."@gmail.com",
        ]);
        $response = $controller->update($request, $user->id);
        $this->assertEquals(204, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_update_user_self_data_success() {

        createRolesAndPermissions();

        $user = $this->createUserAndAuthenticate();

        $controller = App::make(UserController::class);

        $request = new UpdateUserRequest ([
            "first_name" => "testName",
            "last_name" => "testLastname",
            "email" => Str::random(10)."@gmail.com",
        ]);
        $response = $controller->update($request, $user->id);
        $this->assertEquals(204, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_update_user_other_user_data_fail() {

        $this->createUserAndAuthenticate();
        createRolesAndPermissions();

        $user = $this->createUser();

        $controller = App::make(UserController::class);

        $request = new UpdateUserRequest ([
            "first_name" => "testName",
            "last_name" => "testLastname",
            "email" => Str::random(10)."@gmail.com",
        ]);
        $response = $controller->update($request, $user->id);
        $this->assertEquals(403, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_delete_user_admin_success() {

        createRolesAndPermissions();
        $admin = $this->createUserAndAuthenticate();
        $admin->assignRole('admin');

        $user = $this->createUser();

        $controller = App::make(UserController::class);

        $response = $controller->destroy($user->id);
        $this->assertEquals(204, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_delete_user_self_data_success() {

        $user = $this->createUserAndAuthenticate();

        $controller = App::make(UserController::class);

        $response = $controller->destroy($user->id);
        $this->assertEquals(204, $response->resource['status']);
    }

    /**
     * @return void
     */
    public function test_delete_user_other_user_data_fail() {

        $this->createUserAndAuthenticate();
        $user = $this->createUser();

        $controller = App::make(UserController::class);

        $response = $controller->destroy($user->id);
        $this->assertEquals(403, $response->resource['status']);
    }

}
