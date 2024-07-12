<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            "id" => $this->id,
            "number" => $this->number,
            "amount" => $this->amount,
            "status" => $this->status,
            "paid" => $this->paid,
            "user_id" => new UserResource($this->user),
            "order_lines" => $this->order_lines
        ];
    }
}
