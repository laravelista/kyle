<?php

namespace App\Http\Controllers\Api;

use App\Occurrence;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OccurrenceController extends Controller
{
    public function toggleOffer($id, Request $request)
    {
        $this->validate($request, [
            'state' => 'required|boolean'
        ]);

        $occurrence = Occurrence::findOrFail($id);
        $occurrence->offer_sent = $request->get('state');
        $occurrence->save();

        return $occurrence->offer_sent;
    }

    public function togglePayment($id, Request $request)
    {
        $this->validate($request, [
            'state' => 'required|boolean'
        ]);

        $occurrence = Occurrence::findOrFail($id);
        $occurrence->payment_received = $request->get('state');
        $occurrence->save();

        return $occurrence->payment_received;
    }

    public function toggleReceipt($id, Request $request)
    {
        $this->validate($request, [
            'state' => 'required|boolean'
        ]);

        $occurrence = Occurrence::findOrFail($id);
        $occurrence->receipt_sent = $request->get('state');
        $occurrence->save();

        return $occurrence->receipt_sent;
    }
}
