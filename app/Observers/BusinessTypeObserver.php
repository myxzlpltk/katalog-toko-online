<?php

namespace App\Observers;

use App\Models\BusinessType;

class BusinessTypeObserver{

    /**
     * Handle the BusinessType "created" event.
     *
     * @param  \App\Models\BusinessType  $businessType
     * @return void
     */
    public function created(BusinessType $businessType){
        //
    }

    /**
     * Handle the BusinessType "updated" event.
     *
     * @param  \App\Models\BusinessType  $businessType
     * @return void
     */
    public function updated(BusinessType $businessType){
        //
    }

    /**
     * Handle the BusinessType "deleted" event.
     *
     * @param  \App\Models\BusinessType  $businessType
     * @return void
     */
    public function deleted(BusinessType $businessType){
        //
    }

    /**
     * Handle the BusinessType "restored" event.
     *
     * @param  \App\Models\BusinessType  $businessType
     * @return void
     */
    public function restored(BusinessType $businessType){
        //
    }

    /**
     * Handle the BusinessType "force deleted" event.
     *
     * @param  \App\Models\BusinessType  $businessType
     * @return void
     */
    public function forceDeleted(BusinessType $businessType){
        //
    }
}
