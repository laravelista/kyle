<?php

namespace App\Console\Commands;

use App\Service;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Occurrences\OccurrenceCreator;

class SpawnOccurrences extends Command
{
    protected $occurrenceCreator;
    protected $services;
    protected $carbon;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'occurrences:spawn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate occurrences for the upcoming year based on active services.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(OccurrenceCreator $occurrenceCreator, Service $services, Carbon $carbon)
    {
        parent::__construct();

        $this->occurrenceCreator = $occurrenceCreator;
        $this->services = $services;
        $this->carbon = $carbon;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach($this->services->all() as $service) {
            $date = $this->carbon->createFromDate(
                date('Y'),
                $service->month,
                $service->day
            );
            $this->occurrenceCreator->create($date, $service);
        }

        $this->info($this->services->count() . ' occurrences have been spawned');
    }
}
