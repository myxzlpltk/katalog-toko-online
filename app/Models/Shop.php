<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model{

    use HasFactory;

    protected $dates = [
        'monday_open', 'monday_close',
        'tuesday_open', 'tuesday_close',
        'wednesday_open', 'wednesday_close',
        'thursday_open', 'thursday_close',
        'friday_open', 'friday_close',
        'saturday_open', 'saturday_close',
        'sunday_open', 'sunday_close',
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

    public function getLogoPathAttribute(){
    	if($this->logo){
    		return asset("storage/logos/{$this->logo}");
		}
    	else{
    		return asset('img/shop-logo-default.png');
		}
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
