<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'oib', 'street', 'city', 'postal_code'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
