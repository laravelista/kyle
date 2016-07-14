<?php

namespace App\Listeners;

use App\Occurrence;
use App\Events\ServiceWasCreated;
use App\Occurrences\OccurrenceCreator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateServiceOccurrence
{
    protected $occurrenceCreator;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OccurrenceCreator $occurrenceCreator)
    {
        $this->occurrenceCreator = $occurrenceCreator;
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

        $this->occurrenceCreator->create($date, $event->service);

        /**
         * TODO: Maybe do a check here if the occurrence for this service
         * already exists ???
         */
    }
}
