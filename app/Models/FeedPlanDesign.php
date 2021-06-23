<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedPlanDesign extends Model{

    use HasFactory;

    public function feedPlan(){
    	return $this->belongsTo(FeedPlan::class);
	}
}
