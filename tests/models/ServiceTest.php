<?php namespace Tests\Models;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServiceTest extends \TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_form_cost_attribute()
    {
        $service = factory(\App\Service::class)->make([
            'cost' => 100000 // 1.000,00
        ]);

        $this->assertEquals('1000,00', $service->formCostAttribute());
    }

    /** @test */
    public function it_gets_formatted_cost_attribute()
    {
        $service = factory(\App\Service::class)->make([
            'cost' => 100000, // 1.000,00
            'currency' => 'hrk'
        ]);

        $this->assertEquals('1.000,00 HRK', $service->formatted_cost);
    }

    /** @test */
    public function it_gets_sum()
    {
        $user = factory(\App\User::class)->create([
            'preferred_currency' => 'usd'
        ]);

        /**
         * 10 * 100,00 USD = 1.000,00 USD
         */
        $services = factory(\App\Service::class, 10)->make([
            'cost' => 10000, // 100,00
            'currency' => 'eur'
        ]);

        /**
         * This method only works if the user is authenticated.
         * Based on users `preferred_currency` this methods sums
         * all service costs, converts currency using exhange rate
         * to preffered currency and returns formatted string.
         */

        $this->actingAs($user);
        $sum = (new \App\Service)->getSum($services);
        $this->assertEquals('1.000,00 USD', $sum);

        factory(\App\Service::class, 5)->create([
            'cost' => 10000, // 100,00
            'currency' => 'eur'
        ]);

        $sum = (new \App\Service)->getSum();
        $this->assertEquals('500,00 USD', $sum);
    }

    /** @test */
    public function it_gets_sum_for_specific_month()
    {
        $user = factory(\App\User::class)->create([
            'preferred_currency' => 'USD'
        ]);
        $this->actingAs($user);

        factory(\App\Service::class, 5)->create([
            'cost' => 10000, // 100,00
            'currency' => 'eur',
            'month' => 7,
            'active' => true
        ]);

        factory(\App\Service::class, 5)->create([
            'cost' => 10000, // 100,00
            'currency' => 'eur',
            'month' => 8,
            'active' => true
        ]);

        $sum = (new \App\Service)->getSumForMonth(7);
        $this->assertEquals('500,00 USD', $sum);

        factory(\App\Service::class, 5)->create([
            'cost' => 10000, // 100,00
            'currency' => 'eur',
            'month' => 7,
            'active' => false
        ]);

        $sum = (new \App\Service)->getSumForMonth(7, true);
        $this->assertEquals('500,00 USD', $sum);
    }
}