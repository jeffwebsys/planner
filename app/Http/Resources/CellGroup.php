<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class CellGroup extends JsonResource
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

            'data' => [
            'cellgroup_id' => $this->id,
            'last_updated' => $this->updated_at->diffForHumans(),
            
           
            ],
    
            'links' => [
                'self' => $this->path()
            ],
    
    
           ];
    }
}
