<?php namespace Tests\Functional;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReportTest extends \TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_views_report_page()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->visit('/report')
            ->see('Report');
    }
}