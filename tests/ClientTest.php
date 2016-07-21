<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_views_all_clients()
    {
        factory(App\Client::class, 10)->create();

        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/clients')
            ->see('Clients <small>Index</small>');
    }

    /** @test */
    public function it_creates_a_new_client()
    {
        $user = factory(App\User::class)->create();

        $name = 'Pastor';
        $tax_number = '12345678963';
        $street = 'Some random street 12';
        $city = 'A random City';
        $postal_code = '12345';

        $this->actingAs($user)
            ->visit('/clients/create')
            ->see('Clients <small>Create</small>')
            ->type($name, 'name')
            ->type($tax_number, 'tax_number')
            ->type($street, 'street')
            ->type($city, 'city')
            ->type($postal_code, 'postal_code')
            ->press('Save')
            ->seePageIs('/clients')
            ->see('Client Created!')
            ->seeInDatabase('clients', [
                'name' => $name
            ]);
    }

    /** @test */
    public function it_updates_an_existing_client()
    {
        $user = factory(App\User::class)->create();

        $client = factory(App\Client::class)->create([
            'name' => 'Acme building'
        ]);

        $name = 'Acme Company';
        $tax_number = '12345678963';
        $street = 'Some random street 12';
        $city = 'A random City';
        $postal_code = '12345';

        $this->actingAs($user)
            ->visit('/clients/' . $client->id . '/edit')
            ->see('Clients <small>Edit</small>')
            ->type($name, 'name')
            ->type($tax_number, 'tax_number')
            ->type($street, 'street')
            ->type($city, 'city')
            ->type($postal_code, 'postal_code')
            ->press('Update')
            ->see('Client Updated!')
            ->seeInDatabase('clients', [
                'name' => $name
            ]);
    }

    /** @test */
    public function it_deletes_a_client()
    {
        $client = factory(App\Client::class)->create();

        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/clients')
            ->see('Clients <small>Index</small>')
            ->see($client->name)
            ->press('client_' . $client->id)
            ->see('Client Deleted!')
            ->dontSee($client->name);
    }
}
