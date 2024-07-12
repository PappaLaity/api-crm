<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            "id" => $this->id,
            "ref_provider" => $this->ref_provider,
            "provider" => new StructureResource($this->provider),
            "ref_company" => $this->ref_company,
            "company" => new StructureResource($this->company),
            "designation" => $this->designation,
            "barcode" => $this->barcode,
            "price" => $this->price,
        ];
    }
}
