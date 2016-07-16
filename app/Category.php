<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * Get services which belong to this category.
     *
     * @return [type]
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
