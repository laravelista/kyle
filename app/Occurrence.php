<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class Occurrence extends Model
{
    protected $fillable = ['occurs_at', 'offer_sent', 'payment_received', 'receipt_sent'];

    protected $dates = ['occurs_at'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getFutureOfferState()
    {
        return $this->offer_sent ? 0 : 1;
    }

    public function getFuturePaymentState()
    {
        return $this->payment_received ? 0 : 1;
    }

    public function getFutureReceiptState()
    {
        return $this->receipt_sent ? 0 : 1;
    }
}
