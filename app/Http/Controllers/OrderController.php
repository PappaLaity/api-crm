<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return $this->successResponse(OrderResource::collection($orders), "Order List");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedDate = $request->validate([
            "number" => "required|string",
            "amount" => "sometimes",
            "user_id" => "required|string",
        ]);
        $order = Order::create($validatedDate);
        return $this->successResponse(new OrderResource($order), "Order Successfully created", 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $this->successResponse(new OrderResource($order), "Order Details");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validatedDate = $request->validate([
            "amount" => "required",
        ]);
        $order->update($validatedDate);
        return $this->successResponse(new OrderResource($order), "Order Successfully updated");

    }

//    Create API ROUTE
    public function validate(Order $order)
    {
        $data['status'] = OrderStatus::Validated->value;
        $order->update($data);
        return $this->successResponse(new OrderResource($order), "Order Successfully validated");
    }

//    Create API ROUTE
    public function paid(Order $order)
    {
        $data['paid'] = true;
        $order->update($data);
        return $this->successResponse(new OrderResource($order), "Order Successfully paid");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return $this->successResponse(null, "Order successfully deleted");
    }
}
