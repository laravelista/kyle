<?php

namespace App;

use App\Client;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'note', 'month', 'day', 'cost', 'currency', 'active'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
