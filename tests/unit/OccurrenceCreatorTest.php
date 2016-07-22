<?php namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OccurrenceCreatorTest extends \TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_creates_a_new_occurrence()
    {
        $date = \Carbon\Carbon::create(2016, 7, 22, 0, 0, 0);
        $service = factory(\App\Service::class)->create();

        $occurrenceCreator = new \App\Occurrences\OccurrenceCreator;
        $occurrence = $occurrenceCreator->create($date, $service);

        $this->assertInstanceOf(\App\Occurrence::class, $occurrence);

        $this->seeInDatabase('occurrences', [
            'id' => $occurrence->id,
            'occurs_at' => '2016-07-22 00:00:00',
            'offer_sent' => 0,
            'payment_received' => 0,
            'receipt_sent' => 0,
            'service_id' => $service->id
        ]);
    }
}