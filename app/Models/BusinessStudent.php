<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BusinessStudent extends Pivot{

	public function business(){
		return $this->belongsTo(Business::class);
	}

	public function student(){
		return $this->belongsTo(Student::class);
	}
}
