<?php

namespace App\Http\Controllers;

use App\Client;
use App\Service;
use App\Category;
use Carbon\Carbon;
use App\Occurrence;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $occurrences;

    public function __construct(Occurrence $occurrences)
    {
        $this->occurrences = $occurrences;
    }

    public function getOccurrencesForMonth(int $month)
    {
        // Change (int 9) to (string '09')
        if($month < 10) {
            $month = '0' . $month;
        }

        $year = Carbon::now()->year;

        return $this->occurrences->orderBy('occurs_at')
            // Where occurs_at month and year is
            // the same as current month and year
            ->where(function($query) use($month, $year) {
                // $date = 2016-07-%
                $date = $year . '-' . $month . '-%';

                $query->where('occurs_at', 'like', $date);
            })
            // Return only occurrences that belong
            // to services that are active
            ->whereHas('service', function($query) {
                $query->where('active', 1);
            })
            ->with(['service.client'])
            ->get();
    }
    public function getOccurrencesForCurrentMonth()
    {
        $month = Carbon::now()->month;

        return $this->getOccurrencesForMonth($month);
    }

    public function getOccurrencesForNextMonth()
    {
        $month = Carbon::now()->month;
        $occurrences = [];

        if(++$month <= 12){
            $occurrences = $this->getOccurrencesForMonth($month);
        }

        return $occurrences;
    }

    public function getPreviousUnpaidOccurrences()
    {
        $date = Carbon::now();
        $date->day = 1;
        $date->hour = 0;
        $date->minute = 0;
        $date->second = 0;

        return $this->occurrences->orderBy('occurs_at')
            ->where(function($query) use ($date) {
                $query->where('occurs_at', '<', $date);
            })
            ->where('payment_received', 0)
            // Return only occurrences that belong
            // to services that are active
            ->whereHas('service', function($query) {
                $query->where('active', 1);
            })
            ->with(['service.client'])
            ->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $occurrencesThisMonth = $this->getOccurrencesForCurrentMonth();

        $occurrencesNextMonth = $this->getOccurrencesForNextMonth();

        $previousUnpaidOccurrences = $this->getPreviousUnpaidOccurrences();

        return view('home')->with(compact('occurrencesThisMonth', 'occurrencesNextMonth', 'previousUnpaidOccurrences'));
    }

    public function report()
    {
        $services = Service::orderBy('month')
            ->orderBy('day')
            ->where('active', 1)
            ->with(['client', 'category'])
            ->get();

        $clients = Client::orderBy('name')
            ->whereHas('services', function($query) {
                $query->where('active', 1);
            })
            ->with(['services' => function($query) {
                $query->where('active', 1);
            }])
            ->get();

        $categories = Category::orderBy('name')
            ->whereHas('services', function($query) {
                $query->where('active', 1);
            })
            ->with(['services' => function($query) {
                $query->where('active', 1);
            }])
            ->get();

        return view('report')->with(compact('services', 'clients', 'categories'));
    }
}
