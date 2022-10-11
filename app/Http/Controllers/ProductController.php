<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\EmptyContentResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        $products = Product::paginate(10);
        return new ProductCollection(['products'=>$products, 'status'=>200]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductRequest  $request
     * @return JsonResource
     */
    public function store(CreateProductRequest $request): JsonResource
    {
        auth()->user()->products()->create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return new EmptyContentResource(['status'=>201]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function show($id): JsonResource
    {
        $product = Product::find($id);
        if ($product) {
            return new ProductResource(['product'=>$product, 'status'=>200]);
        }

        return new ErrorResource(['message'=>'Undefined product', 'status'=>404]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function edit($id): JsonResource
    {
        $product = Product::find($id);
        if (auth()->user()->cannot('update', $product )){
            return new ErrorResource(['message' => 'You dont have a permission to update this product','status' => 403]);
        };

        return new ProductResource(['product'=>$product, 'status'=>200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param  int  $id
     * @return JsonResource
     */
    public function update(UpdateProductRequest $request, int $id): JsonResource
    {
        $product = Product::find($id);
        if (auth()->user()->cannot('update', $product )){
            return new ErrorResource(['message' => 'You dont have a permission to update this product','status' => 403]);
        };

        $product->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ]);

        return new EmptyContentResource(['status' => 201]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function destroy($id): JsonResource
    {
        $product = Product::find($id);
        if (auth()->user()->can('delete', $product)){
            $product->delete();
            return new EmptyContentResource(['status' => 204]);
        }

        return new ErrorResource(['message'=>'you dont have a permission to delete this post', 'status'=>403]);
    }
}
