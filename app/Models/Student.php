<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model{

    use HasFactory;

	public function business(){
		return $this->belongsTo(Business::class);
	}

	public function user(){
		return $this->morphOne(User::class, 'userable');
	}

	public function getNameAttribute(){
		return $this->user->name;
	}
}
