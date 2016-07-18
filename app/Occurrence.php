<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class Occurrence extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['occurs_at', 'offer_sent', 'payment_received', 'receipt_sent'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['occurs_at'];

    /**
     * Gets a service that belongs to this occurrence.
     *
     * @return [type]
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * If the offer_sent is set to true, this
     * returns false.
     *
     * @return [type]
     */
    public function getFutureOfferState()
    {
        return $this->offer_sent ? 0 : 1;
    }

    /**
     * If the payment_received is set to true
     * this returns false.
     *
     * @return [type]
     */
    public function getFuturePaymentState()
    {
        return $this->payment_received ? 0 : 1;
    }

    /**
     * If the receipt_sent is set to true
     * this returns false.
     *
     * @return [type]
     */
    public function getFutureReceiptState()
    {
        return $this->receipt_sent ? 0 : 1;
    }
}
