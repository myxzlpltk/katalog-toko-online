<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Business extends Model{

    use HasFactory, Searchable;

    protected $appends = ['logo_path'];
	/**
	 * @var mixed
	 */

	public function activeMembers(){
		return $this->hasMany(Student::class)->whereNotNull('validated_at');
	}

    public function businessType(){
    	return $this->belongsTo(BusinessType::class);
	}

	public function candidateMembers(){
		return $this->hasMany(Student::class)->whereNull('validated_at');
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

	public function getLogoPathAttribute(){
		if($this->logo){
			return asset("storage/logos/{$this->logo}");
		}
		else{
			return asset('img/business-logo-default.png');
		}
	}

	public function getBackgroundPathAttribute(){
		if($this->background){
			return asset("storage/backgrounds/{$this->background}");
		}
		else{
			return asset('img/business-background-default.jpg');
		}
	}

	/* Scout */
	public function searchableAs(){
		return 'businesses_index';
	}

	protected function makeAllSearchableUsing($query){
		return $query->with(['teacher.user', 'activeMembers.user', 'businessType.businessField']);
	}

	public function toSearchableArray(){
		return [
			'name' => $this->name,
			'slug' => $this->slug,
			'description' => $this->slug,
			'logo' => $this->logo_path,
			'tagline' => $this->tagline,
			'teacher' => $this->teacher->user->name,
			'members' => $this->activeMembers->pluck('user.name'),
			'business_type' => $this->businessType->name,
			'business_field' => $this->businessType->businessField->name,
			'business_type_id' => $this->businessType->id,
		];
	}
}
