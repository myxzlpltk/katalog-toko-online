<?php

namespace App\Observers;

use App\Models\BusinessPhoto;
use Illuminate\Support\Facades\Storage;

class BusinessPhotoObserver{

    /**
     * Handle the BusinessPhoto "created" event.
     *
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return void
     */
    public function created(BusinessPhoto $businessPhoto){
        //
    }

    /**
     * Handle the BusinessPhoto "updated" event.
     *
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return void
     */
    public function updated(BusinessPhoto $businessPhoto){
        //
    }

    /**
     * Handle the BusinessPhoto "deleted" event.
     *
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return void
     */
    public function deleted(BusinessPhoto $businessPhoto){
		if($businessPhoto->file && Storage::exists("photos/{$businessPhoto->file}")){
			Storage::delete("photos/{$businessPhoto->file}");
		}
    }

    /**
     * Handle the BusinessPhoto "restored" event.
     *
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return void
     */
    public function restored(BusinessPhoto $businessPhoto){
        //
    }

    /**
     * Handle the BusinessPhoto "force deleted" event.
     *
     * @param  \App\Models\BusinessPhoto  $businessPhoto
     * @return void
     */
    public function forceDeleted(BusinessPhoto $businessPhoto){
        //
    }
}
