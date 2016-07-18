<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
