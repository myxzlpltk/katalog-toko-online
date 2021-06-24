<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessField extends Model{

    use HasFactory;

    public function businessTypes(){
    	return $this->hasMany(BusinessType::class)
			->orderBy('name');
	}
}
