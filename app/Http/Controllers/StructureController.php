<?php

namespace App\Http\Controllers;

use App\Enums\StructureType;
use App\Http\Resources\StructureResource;
use App\Models\Structure;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structures = Structure::all();
        return $this->successResponse(StructureResource::collection($structures), "Struture List Successfully recept");
    }

    public function getProviders()
    {
        $structures = Structure::where('typeStructure', StructureType::Provider->value)->get();
        return $this->successResponse(StructureResource::collection($structures), "Struture List Successfully recept");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "nom" => 'required|string',
            "mail" => 'required|email',
            "phone" => "required|string",
            "typeStructure" => "required|string"
        ]);

        $structure = Structure::create($validateData);
        return $this->successResponse(new StructureResource($structure), "Struture Successfully Created", 201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Structure $structure)
    {
        return $this->successResponse(new StructureResource($structure), 'Structure Details');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Structure $structure)
    {
        // Validate Data
        $validatedData = $request->validate([
                "nom" => 'sometimes|string',
                "mail" => 'sometimes|email',
                "phone" => "sometimes|string"
            ]
        );

        // Update Data
        $structure->update($validatedData);

        // Return Json Data and Successfully Update Message
        return $this->successResponse(new StructureResource($structure), 'Structure Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Structure $structure)
    {
        $structure->delete();
        return $this->successResponse(null, 'Structure successfully deleted');

    }
}
