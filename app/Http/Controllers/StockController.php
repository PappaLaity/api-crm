<?php

namespace App\Http\Controllers;

use App\Http\Resources\StockResource;
use App\Models\Stock;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class StockController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::all();
//        return $stocks;
        return $this->successResponse(StockResource::collection($stocks), "Stocks List");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'quantity' => "required|string",
            'price' => "required",
            'ref_company' => "required|string",
        ]);
        $stock = Stock::create($validatedData);
        return $this->successResponse(new StockResource($stock), "New Stock Created", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        return $this->successResponse(new StockResource($stock), "Stock Details");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        $validatedData = $request->validate([
            'quantity' => "sometimes|string",
            'price' => "sometimes",
        ]);
        $stock->update($validatedData);
        return $this->successResponse(new StockResource($stock), "Stock Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return $this->successResponse(null, "Stock successfully deleted");
    }
}
