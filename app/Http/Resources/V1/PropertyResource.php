<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        =>  $this->id,
            'name'      =>  $this->name,
            'price'     =>  $this->price,
            'bedrooms'  =>  $this->bedrooms,
            'bathrooms' =>  $this->bathrooms,
            'storeys'   =>  $this->storeys,
            'garages'   =>  $this->garages
        ];
    }
}
