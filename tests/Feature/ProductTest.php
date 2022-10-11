<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductController;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Tests\Helpers\ProductHelpers;
use Tests\Helpers\UserHelpers;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions, UserHelpers, ProductHelpers;

    /**
     * @return void
     * @throws \Exception
     */
    public function show_products_success ()
    {
        $this->createUserAndAuthenticate();
        $this->createProduct();
        $controller = App::make(ProductController::class);
        $response = $controller->index();
        $this->assertEquals(200, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function test_create_product_user_success ()
    {
        createRolesAndPermissions();
        $this->createUserAndAuthenticate();

        $controller = App::make(ProductController::class);

        $request = new CreateProductRequest([
            'name' => Str::random(),
            'type' => Str::random(),
            'description' => Str::random(),
            'price' => random_int(10,10000),
        ]);

        $response = $controller->store($request);
        $this->assertEquals(201, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function show_existing_product_success ()
    {
        $this->createUserAndAuthenticate();
        $product = $this->createProduct();
        $controller = App::make(ProductController::class);
        $response = $controller->show($product->id);
        $this->assertEquals(200, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function show_unexist_product_fail ()
    {
        $this->createUserAndAuthenticate();
        $product = $this->createProduct();
        $controller = App::make(ProductController::class);
        $response = $controller->show(($product->id)+1);
        $this->assertEquals(404, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function test_edit_product_admin_success ()
    {
        createRolesAndPermissions();
        $user = $this->createUserAndAuthenticate();
        $product = $this->createProduct();
        foreach ($user->tokens as $token) {
            $token->revoke();
        }

        $admin = $this->createUserAndAuthenticate();
        $admin->assignRole('admin');
        $controller = App::make(ProductController::class);

        $response = $controller->edit($product->id);
        $this->assertEquals(200, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function test_edit_self_product_user_success ()
    {
        createRolesAndPermissions();
        $this->createUserAndAuthenticate();
        $product = $this->createProduct();

        $controller = App::make(ProductController::class);

        $response = $controller->edit($product->id);
        $this->assertEquals(200, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function test_edit_other_product_user_fail ()
    {
        createRolesAndPermissions();
        $this->createUserAndAuthenticate();
        $product = $this->createProduct();

        $this->createUserAndAuthenticate();

        $controller = App::make(ProductController::class);

        $response = $controller->edit($product->id);
        $this->assertEquals(403, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function test_update_product_admin_success ()
    {
        createRolesAndPermissions();
        $user = $this->createUserAndAuthenticate();
        $product = $this->createProduct();
        foreach ($user->tokens as $token) {
            $token->revoke();
        }

        $admin = $this->createUserAndAuthenticate();
        $admin->assignRole('admin');
        $controller = App::make(ProductController::class);

        $request = new UpdateProductRequest([
            'name' => Str::random(),
            'type' => Str::random(),
            'description' => Str::random(),
            'price' => random_int(10,10000),
        ]);

        $response = $controller->update($request, $product->id);
        $this->assertEquals(201, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function test_update_self_product_user_success ()
    {
        createRolesAndPermissions();
        $this->createUserAndAuthenticate();
        $product = $this->createProduct();

        $controller = App::make(ProductController::class);

        $request = new UpdateProductRequest([
            'name' => Str::random(),
            'type' => Str::random(),
            'description' => Str::random(),
            'price' => random_int(10,10000),
        ]);

        $response = $controller->update($request, $product->id);
        $this->assertEquals(201, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function test_update_other_product_user_fail ()
    {
        createRolesAndPermissions();
        $this->createUserAndAuthenticate();
        $product = $this->createProduct();

        $this->createUserAndAuthenticate();

        $controller = App::make(ProductController::class);

        $request = new UpdateProductRequest([
            'name' => Str::random(),
            'type' => Str::random(),
            'description' => Str::random(),
            'price' => random_int(10,10000),
        ]);

        $response = $controller->update($request, $product->id);
        $this->assertEquals(403, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function test_admin_delete_product_success()
    {
        createRolesAndPermissions();
        $user = $this->createUserAndAuthenticate();
        $product = $this->createProduct();
        foreach ($user->tokens as $token) {
            $token->revoke();
        }

        $admin = $this->createUserAndAuthenticate();
        $admin->assignRole('admin');
        $controller = App::make(ProductController::class);

        $response = $controller->destroy($product->id);
        $this->assertEquals(204, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function test_user_delete_self_product_success()
    {
        createRolesAndPermissions();
        $this->createUserAndAuthenticate();
        $product = $this->createProduct();

        $controller = App::make(ProductController::class);

        $response = $controller->destroy($product->id);
        $this->assertEquals(204, $response->resource['status']);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function test_user_delete_other_product_fail ()
    {
        createRolesAndPermissions();
        $user = $this->createUserAndAuthenticate();
        $product = $this->createProduct();
        foreach ($user->tokens as $token) {
            $token->revoke();
        }

        $this->createUserAndAuthenticate();
        $controller = App::make(ProductController::class);

        $response = $controller->destroy($product->id);
        $this->assertEquals(403, $response->resource['status']);
    }

}
