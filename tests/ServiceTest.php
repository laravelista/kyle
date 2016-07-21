<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ServiceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_views_all_services()
    {
        factory(App\Service::class, 10)->create();

        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/services')
            ->see('Services <small>Index</small>');
    }

    /** @test */
    public function it_creates_a_new_service()
    {
        $user = factory(App\User::class)->create();

        $category = factory(App\Category::class)->create();
        $client = factory(App\Client::class)->create();

        $title = 'Basic hosting plan';
        $category_id = $category->id;
        $note = 'Service provider is Some company bla bla.';
        $month = 1;
        $day = 1;
        $cost = '100,00';
        $currency = 'usd';
        $exchange_rate = 1;
        $client_id = $client->id;

        $this->actingAs($user)
            ->visit('/services/create')
            ->see('Services <small>Create</small>')
            ->type($title, 'title')
            ->select($category_id, 'category_id')
            ->check('active')
            ->type($note, 'note')
            ->type($month, 'month')
            ->type($day, 'day')
            ->type($cost, 'cost')
            ->type($currency, 'currency')
            ->type($exchange_rate, 'exchange_rate')
            ->select($client_id, 'client_id')
            ->press('Save')
            ->seePageIs('/services')
            ->see('Service Created!')
            ->seeInDatabase('services', [
                'title' => $title
            ]);
    }

    /** @test */
    public function it_updates_an_existing_service()
    {
        $user = factory(App\User::class)->create();

        $service = factory(App\Service::class)->create([
            'title' => 'Some strange plan'
        ]);

        $category = factory(App\Category::class)->create();
        $client = factory(App\Client::class)->create();

        $title = 'Basic hosting plan';
        $category_id = $category->id;
        $note = 'Service provider is Some company bla bla.';
        $month = 1;
        $day = 1;
        $cost = '100,00';
        $currency = 'usd';
        $exchange_rate = 1;
        $client_id = $client->id;

        $this->actingAs($user)
            ->visit('/services/' . $service->id . '/edit')
            ->see('Services <small>Edit</small>')
            ->type($title, 'title')
            ->select($category_id, 'category_id')
            ->check('active')
            ->type($note, 'note')
            ->type($month, 'month')
            ->type($day, 'day')
            ->type($cost, 'cost')
            ->type($currency, 'currency')
            ->type($exchange_rate, 'exchange_rate')
            ->select($client_id, 'client_id')
            ->press('Update')
            ->see('Service Updated!')
            ->seeInDatabase('services', [
                'title' => $title
            ]);
    }

    /** @test */
    public function it_deletes_a_service()
    {
        $service = factory(App\Service::class)->create();

        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/services')
            ->see('Services <small>Index</small>')
            ->see($service->title)
            ->press('service_' . $service->id)
            ->see('Service Deleted!')
            ->dontSee($service->title);
    }
}
