<?php

namespace App\Observers;

use App\Models\Dosen;

class DosenObserver{

    /**
     * Handle the Dosen "created" event.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return void
     */
    public function created(Dosen $dosen){
        //
    }

    /**
     * Handle the Dosen "updated" event.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return void
     */
    public function updated(Dosen $dosen){
        //
    }

    /**
     * Handle the Dosen "deleted" event.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return void
     */
    public function deleted(Dosen $dosen){
        $dosen->user->delete();
    }

    /**
     * Handle the Dosen "restored" event.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return void
     */
    public function restored(Dosen $dosen){
        //
    }

    /**
     * Handle the Dosen "force deleted" event.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return void
     */
    public function forceDeleted(Dosen $dosen){
        //
    }
}
