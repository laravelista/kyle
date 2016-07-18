<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'tax_number', 'street', 'city', 'postal_code'];

    /**
     * Get services which belong to this client.
     *
     * @return [type]
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
