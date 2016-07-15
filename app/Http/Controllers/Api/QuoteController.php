<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Swap\SwapInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuoteController extends Controller
{
    /**
     * It returns a quote from given currency to USD.
     */
    public function getQuote(Request $request, SwapInterface $swap)
    {
        $currency = strtoupper($request->input('currency'));

        return $swap->quote("{$currency}/USD")->getValue();
    }
}
