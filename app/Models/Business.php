<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model{

    use HasFactory;

	public function activeMembers(){
		return $this->hasMany(Student::class)->whereNotNull('validated_at');
	}

    public function businessType(){
    	return $this->belongsTo(BusinessType::class);
	}

	public function feedplans(){
		return $this->hasMany(FeedPlan::class);
	}

	public function members(){
    	return $this->hasMany(Student::class);
	}

	public function owner(){
		return $this->belongsTo(Student::class);
	}

	public function teacher(){
    	return $this->belongsTo(Teacher::class);
	}
}
