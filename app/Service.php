<?php

namespace App;

use App\Client;
use App\Occurance;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'note', 'month', 'day', 'cost', 'currency', 'active'];

    /**
     * To which client does this service belong.
     *
     * @return [type]
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * One per year would be perfect. :)
     *
     * @return [type]
     */
    public function occurances()
    {
        return $this->hasMany(Occurance::class);
    }
}
