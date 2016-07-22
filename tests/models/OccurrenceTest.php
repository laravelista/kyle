<?php namespace Tests\Models;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OccurrenceTest extends \TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_gets_future_offer_state()
    {
        $occurrence = factory(\App\Occurrence::class)->make([
            'offer_sent' => true
        ]);
        $this->assertEquals(0, $occurrence->getFutureOfferState());

        $occurrence = factory(\App\Occurrence::class)->make([
            'offer_sent' => false
        ]);
        $this->assertEquals(1, $occurrence->getFutureOfferState());
    }

    /** @test */
    public function it_gets_future_payment_state()
    {
        $occurrence = factory(\App\Occurrence::class)->make([
            'payment_received' => true
        ]);
        $this->assertEquals(0, $occurrence->getFuturePaymentState());

        $occurrence = factory(\App\Occurrence::class)->make([
            'payment_received' => false
        ]);
        $this->assertEquals(1, $occurrence->getFuturePaymentState());
    }

    /** @test */
    public function it_gets_future_receipt_state()
    {
        $occurrence = factory(\App\Occurrence::class)->make([
            'receipt_sent' => true
        ]);
        $this->assertEquals(0, $occurrence->getFutureReceiptState());

        $occurrence = factory(\App\Occurrence::class)->make([
            'receipt_sent' => false
        ]);
        $this->assertEquals(1, $occurrence->getFutureReceiptState());
    }
}