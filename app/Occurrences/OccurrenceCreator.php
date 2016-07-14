<?php

namespace App\Occurrences;

use App\Service;
use Carbon\Carbon;
use App\Occurrence;

class OccurrenceCreator
{
    public function create(Carbon $date, Service $service)
    {
        $occurrence = new Occurrence;
        $occurrence->occurs_at = $date->timestamp;
        $occurrence->offer_sent = false;
        $occurrence->payment_received = false;
        $occurrence->receipt_sent = false;
        $occurrence->service()->associate($service);
        $occurrence->save();
    }

}
