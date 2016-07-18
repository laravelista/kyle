<?php

use Illuminate\Database\Seeder;

/**
 * Seeds the database with sample data so that the user
 * can see what the application looks like with data entered.
 *
 * 10 clients with 10 services each.
 * Each service is assigned a category from a pool of categories.
 */
class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Just a shortcut for creating occurrences.
         *
         * When a service is created we want to trigger a event
         * `ServiceWasCreated` which then creates an occurrence
         * for that service.
         */
        App\Service::created(function($service) {
            event(new App\Events\ServiceWasCreated($service));
        });

        $categories = ['Hosting', 'Maintenance', 'Domain', 'SSL Certificate'];

        array_map(function($category) {
            return factory(App\Category::class)->create([
                'name' => $category
            ]);
        }, $categories);

        $clients = factory(App\Client::class, 10)->create();

        foreach($clients as $client) {
            $services = factory(App\Service::class, 10)->create([
                'client_id' => $client->id,
                'category_id' => rand(1, count($categories))
            ]);
        }

        /**
         * Sample User for testing purposes:
         *
         * email: sample.user@email.com
         * password: password
         *
         */
        factory(App\User::class)->create([
            'name' => 'Sample User',
            'email' => 'sample@user.dev',
            'password' => bcrypt('password'),
            'preferred_currency' => 'usd'
        ]);

        /**
         * Cleanup
         *
         * Because there is a long standing bug in Laravel
         * with model factories, I need to manually remove extra
         * records created.
         */
        App\Category::has('services', '=', 0)->delete();
        App\Client::has('services', '=', 0)->delete();

    }
}
