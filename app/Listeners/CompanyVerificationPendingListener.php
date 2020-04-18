<?php

namespace App\Listeners;

use App\Events\CompanyVerificationPendingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CompanyVerificationPendingListener
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
     * @param  CompanyVerificationPendingEvent  $event
     * @return void
     */
    public function handle(CompanyVerificationPendingEvent $event)
    {
        //
    }
}
