<?php namespace Tests\Functional;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SettingsTest extends \TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_updates_settings()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'Test Dummy',
            'email' => 'test@test.dummy',
            'preferred_currency' => 'hrk',
            'email_notifications' => false
        ]);

        $name = 'Not A Test Dummy';
        $email = 'not.a.fake@email.address';
        $preferred_currency = 'usd';

        $this->actingAs($user)
            ->visit('/settings')
            ->see('Settings')
            ->type($name, 'name')
            ->type($email, 'email')
            ->select($preferred_currency, 'preferred_currency')
            ->check('email_notifications')
            ->press('Update')
            ->see('Settings updated!')
            ->seeInDatabase('users', [
                'name' => $name,
                'email' => $email,
                'preferred_currency' => $preferred_currency,
                'email_notifications' => 1
            ]);
    }
}