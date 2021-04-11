<?php

namespace App\Observers;

use App\Models\Shop;
use Illuminate\Support\Facades\Storage;

class ShopObserver{

    /**
     * Handle the Shop "created" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function created(Shop $shop){
        //
    }

    /**
     * Handle the Shop "updated" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function updated(Shop $shop){
		if($shop->wasChanged('logo')){
			$oldLogo = $shop->getOriginal('logo');

			if(Storage::exists("logos/{$oldLogo}")) {
				Storage::delete("logos/{$oldLogo}");
			}
		}
    }

    /**
     * Handle the Shop "deleted" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function deleted(Shop $shop){
		if($shop->logo && Storage::exists("logos/{$shop->logo}")){
			Storage::delete("logos/{$shop->logo}");
		}

        foreach($shop->reviews as $review){
        	$review->delete();
		}

		foreach($shop->photos as $photo){
			$photo->delete();
		}
    }

    /**
     * Handle the Shop "restored" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function restored(Shop $shop){
        //
    }

    /**
     * Handle the Shop "force deleted" event.
     *
     * @param  \App\Models\Shop  $shop
     * @return void
     */
    public function forceDeleted(Shop $shop){
        //
    }
}
