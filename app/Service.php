<?php

namespace App;

use App\Client;
use App\Category;
use App\Occurrence;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Collection;

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
     * To which category does this service belong.
     *
     * @return [type]
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
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
     * Returns formatted cost with currency.
     * Converts `112345 usd` to `1.123,45 USD`.
     *
     * @return string
     */
    public function getFormattedCostAttribute()
    {
        return number_format($this->cost / 100, 2, ',', '.') . ' ' . strtoupper($this->currency);
    }

    public function getSum(Collection $services = null)
    {
        if(!($services instanceof Collection)) {
            $services = $this->all();
        }
        $preferredCurrency = strtoupper(auth()->user()->preferred_currency);

        $sum = 0;
        foreach($services as $service) {
            $currentCurrency = strtoupper($service->currency);
            $exchange_rate = \Swap::quote("{$currentCurrency}/{$preferredCurrency}")
                ->getValue();
            $sum+= ($service->cost / 100) * $exchange_rate;
        }
        //$sum = ceil($sum);

        return number_format($sum, 2, ',', '.') . ' ' . $preferredCurrency;
    }

    public function getSumForMonth(int $month, $onlyActive = false)
    {
        $services = $this->where('month', $month);
        if($onlyActive) {
            $services->where('active', 1);
        }
        $services = $services->get();

        return $this->getSum($services);
    }
}
