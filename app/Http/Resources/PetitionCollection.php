<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PetitionCollection extends ResourceCollection
{

    public $collects = PetitionResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        # return parent::toArray($request);

        return [
            'data' => $this->collection,
            'meta' => [
                'organization' => 'Nowhere',
                'author' => 'Nobody', 
                'version' => '0.1.1', 
            ]
        ]; 
    }
}
