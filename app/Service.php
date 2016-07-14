<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'note', 'month', 'day', 'cost', 'currency', 'active'];
}
