<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){
        return [
			'id' => $this->id,
			'name' => $this->name,
			'review_text' => $this->review_text,
			'rating' => $this->rating,
			'created_at' => $this->created_at,
		];
    }
}
