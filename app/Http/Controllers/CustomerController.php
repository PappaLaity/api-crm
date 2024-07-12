<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return $this->successResponse(CustomerResource::collection($customers), "Customer's List");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "firstname" => "required|string",
            "lastname" => "required|string",
            "phone" => "required|string",
        ]);
        $customer = Customer::create($validatedData);
        return $this->successResponse(new CustomerResource($customer), "Customer successfully created", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return $this->successResponse(new CustomerResource($customer), "Customer Details");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            "firstname" => "sometimes|string",
            "lastname" => "sometimes|string",
            "phone" => "sometimes|string",
        ]);
        $customer->update($validatedData);
        return $this->successResponse(new CustomerResource($customer), "Customer updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return $this->successResponse(null, "Customer deleted");
    }
}
