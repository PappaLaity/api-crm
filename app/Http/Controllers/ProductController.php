<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return $this->successResponse(ProductResource::collection($products), "Product List");
    }


    public function getProductForCompany($id)
    {
        $products = Product::where('company_id', $id)->get();
        return $this->successResponse(ProductResource::collection($products), "Product List");

    }

    public function getProductForProvider($id)
    {
        $products = Product::where('provider_id', $id)->get();
        return $this->successResponse(ProductResource::collection($products), "Product List");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Data should Contain
        // REF Provider -
        // DESIGNATION -
        // BARCODE -
        // ProviderID

        $validatedData = $request->validate([
            "designation" => "required|string",
            "barcode" => "required|string",
            "ref_provider" => "required|string",
            "provider_id" => "required|string",
            "price" => "required",

        ]);
        $product = Product::create($validatedData);
        return $this->successResponse(new ProductResource($product), "Product Successfully created", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->successResponse(new ProductResource($product), "Product's Details");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Data should Contain
        // REF Company -
        // Company ID
        $validatedData = $request->validate([
            "designation" => "sometimes|string",
            "ref_company" => "sometimes|string",
            "company_id" => "sometimes|string",
            "price" => "sometimes",

        ]);
        $product->update($validatedData);
        return $this->successResponse(new ProductResource($product), "Product Successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->successResponse(null, "Product Deleted");
    }
}
