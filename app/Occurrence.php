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
}
