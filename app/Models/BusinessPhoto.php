<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPhoto extends Model{

    use HasFactory;

    public function business(){
    	return $this->belongsTo(Business::class);
	}
}
