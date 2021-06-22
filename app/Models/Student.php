<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model{

    use HasFactory;

	public function businesses(){
		return $this->belongsToMany(Business::class)->using(BusinessStudent::class);
	}

	public function user(){
		return $this->morphOne(User::class, 'userable');
	}

	public function getActiveBusinessAttribute(){
		return $this->businesses()->first();
	}

	public function getNameAttribute(){
		return $this->user->name;
	}
}
