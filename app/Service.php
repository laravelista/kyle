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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
     * Converts 112345 to 1123,45.
     * For forms only.
     *
     * @return string
     */
    public function formCostAttribute()
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

    /**
     * Gets the sum of all services, converted to user's
     * preferred currency with current exchange rate.
     *
     * It is possible to pass a collection of services to this method,
     * and it will return the sum of that collection.
     *
     * @param  Collection|null $services
     * @return [type]
     */
    public function getSum(Collection $services = null)
    {
        if(!($services instanceof Collection)) {
            $services = $this->all();
        }

        $sum = 0;
        foreach($services as $service) {
            $currentCurrency = strtoupper($service->currency);
            $sum+= ($service->cost / 100);
        }

        return number_format($sum, 2, ',', '.') . ' ' . $currentCurrency;
    }

    /**
     * Gets the sum of all services, converted to user's
     * preferred currency with current exchange rate for the entered month.
     *
     * By default, all services are included (active and non active).
     *
     * @param  $month
     * @param  boolean $onlyActive
     * @return [type]
     */
    public function getSumForMonth($month, $onlyActive = false)
    {
        $services = $this->where('month', $month);
        if($onlyActive) {
            $services->where('active', 1);
        }
        $services = $services->get();

        return $this->getSum($services);
    }
}
