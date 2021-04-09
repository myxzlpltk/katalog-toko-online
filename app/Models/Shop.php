<?php

namespace App\Models;

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
}
