<?php

namespace App\Http\Controllers\Api;

use App\Occurrence;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OccurrenceController extends Controller
{
    public function toggleOffer(Occurrence $occurrence, Request $request)
    {
        $this->validate($request, [
            'state' => 'required|boolean'
        ]);

        $occurrence->offer_sent = $request->get('state');
        $occurrence->save();

        return $occurrence->offer_sent;
    }

    public function togglePayment(Occurrence $occurrence, Request $request)
    {
        $this->validate($request, [
            'state' => 'required|boolean'
        ]);

        var_dump($occurrence->occurs_at);

        $occurrence->payment_received = $request->get('state');
        $occurrence->save();

        var_dump($occurrence->occurs_at);

        return $occurrence->payment_received;
    }

    public function toggleReceipt(Occurrence $occurrence, Request $request)
    {
        $this->validate($request, [
            'state' => 'required|boolean'
        ]);

        $occurrence->receipt_sent = $request->get('state');
        $occurrence->save();

        return $occurrence->receipt_sent;
    }
}
