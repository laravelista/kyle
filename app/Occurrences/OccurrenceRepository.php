<?php namespace App\Occurrences;

use App\Occurrence;
use Carbon\Carbon;

class OccurrenceRepository
{
    /**
     *
     * @var [type]
     */
    protected $occurrences;

    /**
     *
     * @param Occurrence $occurrences
     */
    public function __construct(Occurrence $occurrences)
    {
        $this->occurrences = $occurrences;
    }

    /**
     * It gets occurrences for specified month in current year
     * but only occurrences that belong to a service that is
     * active and eager loads service.client nested relationship.
     *
     * @param  int $month
     * @return [type]
     */
    public function getOccurrencesForMonth(int $month)
    {
        // Change (int 9) to (string '09')
        if ($month < 10) {
            $month = '0' . $month;
        }

        $year = Carbon::now()->year;

        return $this->occurrences
            ->orderBy('occurs_at')
            ->where(function ($query) use ($month, $year) {
                // $date = 2016-07-%
                $date = $year . '-' . $month . '-%';
                $query->where('occurs_at', 'like', $date);
            })
            ->whereHas('service', function ($query) {
                $query->where('active', 1);
            })
            ->with(['service.client'])
            ->get();
    }

    /**
     * It gets active occurrences for current month.
     *
     * @return [type]
     */
    public function getOccurrencesForCurrentMonth()
    {
        $month = Carbon::now()->month;

        return $this->getOccurrencesForMonth($month);
    }

    /**
     * It gets active occurrences for the upcoming month.
     *
     * @return [type]
     */
    public function getOccurrencesForNextMonth()
    {
        $month = Carbon::now()->month;
        $occurrences = [];

        if (++$month <= 12) {
            $occurrences = $this->getOccurrencesForMonth($month);
        }

        return $occurrences;
    }

    /**
     * It gets all active occurrences that are not paid
     * for this year up to the current month.
     *
     * @return [type]
     */
    public function getPreviousUnpaidOccurrences()
    {
        $date = Carbon::now();
        $date->day = 1;
        $date->hour = 0;
        $date->minute = 0;
        $date->second = 0;

        return $this->occurrences
            ->orderBy('occurs_at')
            ->where(function ($query) use ($date) {
                $query->where('occurs_at', '<', $date);
            })
            ->where('payment_received', 0)
            ->whereHas('service', function ($query) {
                $query->where('active', 1);
            })
            ->with(['service.client'])
            ->get();
    }

}
