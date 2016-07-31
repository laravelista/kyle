<?php

namespace App\Http\Controllers;

use App\Client;
use App\Service;
use App\Category;
use App\Occurrences\OccurrenceRepository;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OccurrenceRepository $occurrenceRepository)
    {
        $occurrencesThisMonth = $occurrenceRepository->getOccurrencesForCurrentMonth();
        $occurrencesNextMonth = $occurrenceRepository->getOccurrencesForNextMonth();
        $previousUnpaidOccurrences = $occurrenceRepository->getPreviousUnpaidOccurrences();

        return view('home')->with(compact(
            'occurrencesThisMonth',
            'occurrencesNextMonth',
            'previousUnpaidOccurrences'
        ));
    }

    /**
     * Show the report for all things.
     *
     * @return [type]
     */
    public function report()
    {
        $services = Service::orderBy('month')
            ->orderBy('day')
            ->where('active', 1)
            ->with(['client', 'category'])
            ->get();

        $clients = Client::orderBy('name')
            ->whereHas('services', function ($query) {
                $query->where('active', 1);
            })
            ->with(['services' => function ($query) {
                $query->where('active', 1);
            }])
            ->get();

        $categories = Category::orderBy('name')
            ->whereHas('services', function ($query) {
                $query->where('active', 1);
            })
            ->with(['services' => function ($query) {
                $query->where('active', 1);
            }])
            ->get();

        return view('report')->with(compact('services', 'clients', 'categories'));
    }
}
