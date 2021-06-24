<?php

namespace App\Observers;

use App\Models\FeedPlanDesign;
use Illuminate\Support\Facades\Storage;

class FeedPlanDesignObserver{

    /**
     * Handle the FeedPlanDesign "created" event.
     *
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return void
     */
    public function created(FeedPlanDesign $feedPlanDesign){
        //
    }

    /**
     * Handle the FeedPlanDesign "updated" event.
     *
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return void
     */
    public function updated(FeedPlanDesign $feedPlanDesign){
        //
    }

    /**
     * Handle the FeedPlanDesign "deleted" event.
     *
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return void
     */
    public function deleted(FeedPlanDesign $feedPlanDesign){
		if($feedPlanDesign->design && Storage::exists("designs/{$feedPlanDesign->design}")){
			Storage::delete("designs/{$feedPlanDesign->design}");
		}
    }

    /**
     * Handle the FeedPlanDesign "restored" event.
     *
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return void
     */
    public function restored(FeedPlanDesign $feedPlanDesign){
        //
    }

    /**
     * Handle the FeedPlanDesign "force deleted" event.
     *
     * @param  \App\Models\FeedPlanDesign  $feedPlanDesign
     * @return void
     */
    public function forceDeleted(FeedPlanDesign $feedPlanDesign){
        //
    }
}
