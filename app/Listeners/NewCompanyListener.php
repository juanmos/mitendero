<?php

namespace App\Listeners;

use App\Events\NewCompanyEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewCompanyListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewCompanyEvent  $event
     * @return void
     */
    public function handle(NewCompanyEvent $event)
    {
        //
    }
}
