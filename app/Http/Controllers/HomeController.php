<?php

namespace App\Http\Controllers;

use App\Occurrence;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $occurrences = Occurrence::orderBy('occurs_at')
        // Where occurs_at month and year is the same as current month and year
        ->where(function($query) use($currentMonth, $currentYear) {
            $query->where('occurs_at', 'like', $currentYear . '-' . $currentMonth . '-%');
        })
        // Return only occurrences that belong to services that are active
        ->whereHas('service', function($query) {
            $query->where('active', 1);
        })->with(['service.client'])->get();

        if($currentMonth + 1 <= 12){
            $upcomingMonth = ++$currentMonth;
            if($upcomingMonth < 10) {
                $upcomingMonth = '0' . $upcomingMonth;
            }
            $upcomingOccurrences = Occurrence::orderBy('occurs_at')
            // Where occurs_at month and year is the same as upcoming month and current year
            ->where(function($query) use($upcomingMonth, $currentYear) {
                $query->where('occurs_at', 'like', $currentYear . '-' . $upcomingMonth . '-%');
            })
            // Return only occurrences that belong to services that are active
            ->whereHas('service', function($query) {
                $query->where('active', 1);
            })->with(['service.client'])->get();
        }
        else {
            $upcomingOccurrences = [];
        }


        return view('home')->with(compact('occurrences', 'upcomingOccurrences'));
    }
}
