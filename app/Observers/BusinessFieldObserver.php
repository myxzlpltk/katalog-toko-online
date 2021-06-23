<?php

namespace App\Observers;

use App\Models\BusinessField;

class BusinessFieldObserver{

    /**
     * Handle the BusinessField "created" event.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @return void
     */
    public function created(BusinessField $businessField){
        //
    }

    /**
     * Handle the BusinessField "updated" event.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @return void
     */
    public function updated(BusinessField $businessField){
        //
    }

    /**
     * Handle the BusinessField "deleted" event.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @return void
     */
    public function deleted(BusinessField $businessField){
        //
    }

    /**
     * Handle the BusinessField "restored" event.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @return void
     */
    public function restored(BusinessField $businessField){
        //
    }

    /**
     * Handle the BusinessField "force deleted" event.
     *
     * @param  \App\Models\BusinessField  $businessField
     * @return void
     */
    public function forceDeleted(BusinessField $businessField){
        //
    }
}
