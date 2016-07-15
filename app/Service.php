<?php

namespace App;

use App\Client;
use App\Occurrence;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;

class Service extends Model
{
    use FormAccessible;

    protected $fillable = ['title', 'note', 'month', 'day', 'cost', 'currency', 'active', 'exchange_rate'];

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
    public function occurrences()
    {
        return $this->hasMany(Occurrence::class);
    }

    /**
     * Converts 112345 to 1.123,45.
     * For forms only.
     *
     * @param  integer $value
     * @return string
     */
    public function formCostAttribute($value)
    {
        return number_format($this->cost / 100, 2, ',', '');
    }

    /**
     * Converts 112345 to 1.123,45.
     * For forms only.
     *
     * @param  integer $value
     * @return string
     */
    public function formExchangeRateAttribute($value)
    {
        return number_format($this->exchange_rate , 4, ',', '.');
    }

    /**
     * Returns formatted cost with currency.
     * Converts `112345 usd` to `1.123,45 USD`.
     *
     * @return string
     */
    public function getFormattedCostAttribute()
    {
        return number_format($this->cost / 100, 2, ',', '.') . ' ' . strtoupper($this->currency);
    }
}
