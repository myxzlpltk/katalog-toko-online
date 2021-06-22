<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model{

    use HasFactory;

	public function activeMembers(){
		return $this->belongsToMany(Student::class)
			->using(BusinessStudent::class)
			->where('is_valid', true);
	}

    public function businessType(){
    	return $this->belongsTo(BusinessType::class);
	}

	public function members(){
    	return $this->belongsToMany(Student::class)
			->using(BusinessStudent::class);
	}

	public function teacher(){
    	return $this->belongsTo(Teacher::class);
	}

	public function getOwnerAttribute(){
		return $this->members()
			->where('role', 'owner')
			->first();
	}
}
