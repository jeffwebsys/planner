<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Member extends JsonResource
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
            'member_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'company' => $this->company,
            'position' => $this->position,
            'location' => $this->location,
            'offerings' => $this->offerings,
            'birthday' => $this->birthday->format('m/d/Y'),
            'last_updated' => $this->updated_at->diffForHumans(),
            
           
            ],
    
            'links' => [
                'self' => $this->path()
            ],
    
    
           ];
    }
}
