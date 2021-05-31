<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){
        return [
			'id' => (int)$this->id,
			'category' => $this->whenLoaded('category', function (){
				return $this->category->name;
			}),
			'name' => $this->name,
			'description' => $this->description,
			'logo' => $this->logo_path,
			'address' => $this->address,
			'phone_number' => $this->phone_number,
			'price_range' => $this->price_range,
			'monday_open' => $this->monday_open,
			'monday_close' => $this->monday_close,
			'tuesday_open' => $this->tuesday_open,
			'tuesday_close' => $this->tuesday_close,
			'wednesday_open' => $this->wednesday_open,
			'wednesday_close' => $this->wednesday_close,
			'thursday_open' => $this->thursday_open,
			'thursday_close' => $this->thursday_close,
			'friday_open' => $this->friday_open,
			'friday_close' => $this->friday_close,
			'saturday_open' => $this->saturday_open,
			'saturday_close' => $this->saturday_close,
			'sunday_open' => $this->sunday_open,
			'sunday_close' => $this->sunday_close,
			'public_reviews_avg_rating' => round((double)$this->public_reviews_avg_rating, 1),
			'public_reviews_count' => (int)$this->public_reviews_count,
			'photos_max_file' => $this->photos_max_file ? asset("storage/photos/{$this->photos_max_file}") : asset("img/no-photo.jpg"),
			'is_open' => $this->is_open,
			'photos' => new PhotoCollection($this->whenLoaded('photos')),
			'reviews' => new ReviewCollection($this->whenLoaded('public_reviews')),
			'count_reviews' => $this->whenLoaded('public_reviews', function (){
				return $this->count_reviews;
			})
		];
    }
}
