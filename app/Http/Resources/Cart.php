<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'product_id' => $this->product_id,
            'qty' => $this->qty,
            'session_id' => $this->session_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'productdata' => $this->product,
            'categorydata' => $this->category,
        ];
    }
}
