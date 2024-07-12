<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderLineResource;
use App\Models\OrderLine;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class OrderLineController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordersLines = OrderLine::all();
        return $this->successResponse(OrderLineResource::collection($ordersLines), "Order Line List");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        should contain the id product and id orders
        $validatedData = $request->validate([
            "product_id" => "required|string",
            "order_id" => "required|string",
            "quantity" => "required",
            "price" => "required", // Provider price * Quantity
        ]);
        $orderLine = OrderLine::create($validatedData);
        return $this->successResponse(new OrderLineResource($orderLine), "Order Line Created", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderLine $orderLine)
    {
        return $this->successResponse(new OrderLineResource($orderLine), "Order Line Details");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderLine $orderLine)
    {
        $validatedData = $request->validate([
            "quantity" => "sometimes",
            "price" => "sometimes", // Provider price * Quantity
        ]);
        $orderLine->update($validatedData);
        return $this->successResponse(new OrderLineResource($orderLine), "OrderLine Successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderLine $orderLine)
    {
        $orderLine->delete();
        return $this->successResponse(null, "Order Line Deleted");
    }
}
