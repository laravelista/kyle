<?php

namespace App\Listeners;

use App\Occurrence;
use App\Events\ServiceWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateServiceOccurrence
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
     * @param  ServiceWasCreated  $event
     * @return void
     */
    public function handle(ServiceWasCreated $event)
    {
        $date = \Carbon\Carbon::createFromDate(
            date('Y'),
            $event->service->month,
            $event->service->day
        );

        $occurence = new Occurrence;
        $occurence->occurs_at = $date->timestamp;
        $occurence->offer_sent = false;
        $occurence->payment_received = false;
        $occurence->receipt_sent = false;
        $occurence->service()->associate($event->service);
        $occurence->save();

        /**
         * TODO: Maybe do a check here if the occurence for this service
         * already exists ???
         */
    }
}
