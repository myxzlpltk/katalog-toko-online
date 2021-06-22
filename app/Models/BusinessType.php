<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model{

    use HasFactory;

    public function businessField(){
    	return $this->belongsTo(BusinessField::class);
	}

	public function businesses(){
    	return $this->hasMany(Business::class);
	}
}
