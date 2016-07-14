<?php

namespace App\Listeners;

use App\Events\ServiceWasUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateServiceOccurrences
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
     * @param  ServiceWasUpdated  $event
     * @return void
     */
    public function handle(ServiceWasUpdated $event)
    {
        foreach($event->service->occurrences()->get() as $occurence)
        {
            $date = \Carbon\Carbon::createFromDate(
                $occurence->occurs_at->year,
                $event->service->month,
                $event->service->day
            );

            $occurence->occurs_at = $date->timestamp;
            $occurence->save();
        }
    }
}
