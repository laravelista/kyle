<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    protected $fillable = ['occurs_at', 'offer_sent', 'payment_received', 'receipt_sent'];
}
