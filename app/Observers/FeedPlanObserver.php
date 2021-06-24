<?php

namespace App\Observers;

use App\Models\FeedPlan;
use Illuminate\Support\Facades\Storage;

class FeedPlanObserver{

    /**
     * Handle the FeedPlan "created" event.
     *
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return void
     */
    public function created(FeedPlan $feedPlan){
        //
    }

    /**
     * Handle the FeedPlan "updated" event.
     *
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return void
     */
    public function updated(FeedPlan $feedPlan){
		if($feedPlan->wasChanged('brief_image')){
			$oldLogo = $feedPlan->getOriginal('brief_image');

			if(Storage::exists("briefs/{$oldLogo}")) {
				Storage::delete("briefs/{$oldLogo}");
			}
		}
    }

    /**
     * Handle the FeedPlan "deleted" event.
     *
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return void
     */
    public function deleted(FeedPlan $feedPlan){
		if($feedPlan->brief_image && Storage::exists("briefs/{$feedPlan->brief_image}")){
			Storage::delete("briefs/{$feedPlan->brief_image}");
		}

		foreach($feedPlan->designs as $design){
			$design->delete();
		}
    }

    /**
     * Handle the FeedPlan "restored" event.
     *
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return void
     */
    public function restored(FeedPlan $feedPlan){
        //
    }

    /**
     * Handle the FeedPlan "force deleted" event.
     *
     * @param  \App\Models\FeedPlan  $feedPlan
     * @return void
     */
    public function forceDeleted(FeedPlan $feedPlan){
        //
    }
}
