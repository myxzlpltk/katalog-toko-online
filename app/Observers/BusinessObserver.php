<?php

namespace App\Observers;

use App\Models\Business;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BusinessObserver{

    /**
     * Handle the Business "created" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function created(Business $business){
		$business->slug = Str::slug("{$business->name} {$business->id}");
		$business->save();
    }

	/**
	 * Handle the Business "updating" event.
	 *
	 * @param  \App\Models\Business  $business
	 * @return void
	 */
    public function updating(Business $business){
		if(!$business->wasRecentlyCreated && $business->wasChanged('name')){
			$business->slug = Str::slug("{$business->name} {$business->id}");
		}
	}

    /**
     * Handle the Business "updated" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function updated(Business $business){
		if($business->wasChanged('logo')){
			$oldLogo = $business->getOriginal('logo');

			if(Storage::exists("logos/{$oldLogo}")) {
				Storage::delete("logos/{$oldLogo}");
			}
		}

		if($business->wasChanged('background')){
			$oldBackground = $business->getOriginal('background');

			if(Storage::exists("backgrounds/{$oldBackground}")) {
				Storage::delete("backgrounds/{$oldBackground}");
			}
		}
    }

    /**
     * Handle the Business "deleted" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function deleted(Business $business){
		if($business->logo && Storage::exists("logos/{$business->logo}")){
			Storage::delete("logos/{$business->logo}");
		}
		if($business->background && Storage::exists("backgrounds/{$business->background}")){
			Storage::delete("backgrounds/{$business->background}");
		}

		$business->members()->update(['business_id' => null, 'validated_at' => null]);

		foreach($business->feedplans as $feedplan){
			$feedplan->delete();
		}

		foreach($business->photos as $photo){
			$photo->delete();
		}
    }

    /**
     * Handle the Business "restored" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function restored(Business $business){
        //
    }

    /**
     * Handle the Business "force deleted" event.
     *
     * @param  \App\Models\Business  $business
     * @return void
     */
    public function forceDeleted(Business $business){
        //
    }
}
