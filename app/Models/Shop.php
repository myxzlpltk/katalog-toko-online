<?php

namespace App\Models;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model{

    use HasFactory;

    protected $dates = [
		'sunday_open', 'sunday_close',
        'monday_open', 'monday_close',
        'tuesday_open', 'tuesday_close',
        'wednesday_open', 'wednesday_close',
        'thursday_open', 'thursday_close',
        'friday_open', 'friday_close',
        'saturday_open', 'saturday_close',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

	public function reviews(){
		return $this->hasMany(Review::class);
	}

	public function public_reviews(){
		return $this->hasMany(Review::class)
			->where('published_at', '!=', null)
			->orderByDesc('created_at')
			->orderByDesc('rating');
	}

    public function getLogoPathAttribute(){
    	if($this->logo){
    		return asset("storage/logos/{$this->logo}");
		}
    	else{
    		return asset('img/shop-logo-default.png');
		}
	}

	public function getIsOpenAttribute(){
    	$now = Carbon::now();
		$dayWeek = $now->dayOfWeek;

		$open = $this->getAttribute($this->dates[$dayWeek*2]);
		$close = $this->getAttribute($this->dates[$dayWeek*2+1]);

		return $open && $close && $now->gte($open) && $now->lte($close);
	}

	public function getPriceRangeAttribute(){
    	if($this->min_price && $this->max_price){
    		return Helper::idr($this->min_price)." - ".Helper::idr($this->max_price);
		}
    	elseif(!$this->min_price && $this->max_price){
			return "Hingga ".Helper::idr($this->max_price);
		}
		elseif($this->min_price && !$this->max_price){
			return "Mulai ".Helper::idr($this->min_price);
		}
	}
}
