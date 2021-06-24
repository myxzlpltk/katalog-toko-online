<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedPlan extends Model{

    use HasFactory;

    protected $dates = ['plan_date'];

    public function business(){
    	return $this->belongsTo(Business::class);
	}

	public function designs(){
    	return $this->hasMany(FeedPlanDesign::class);
	}
}
