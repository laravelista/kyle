<?php namespace Tests\Functional;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends \TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_views_all_categories()
    {
        factory(\App\Category::class, 10)->create();

        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->visit('/categories')
            ->see('Categories <small>Index</small>');
    }

    /** @test */
    public function it_creates_a_new_category()
    {
        $user = factory(\App\User::class)->create();

        $name = 'Hosting';

        $this->actingAs($user)
            ->visit('/categories/create')
            ->see('Categories <small>Create</small>')
            ->type($name, 'name')
            ->press('Save')
            ->seePageIs('/categories')
            ->see('Category Created!')
            ->seeInDatabase('categories', [
                'name' => $name
            ]);
    }

    /** @test */
    public function it_updates_an_existing_category()
    {
        $user = factory(\App\User::class)->create();

        $category = factory(\App\Category::class)->create([
            'name' => 'Hostingg'
        ]);

        $name = 'Hosting';

        $this->actingAs($user)
            ->visit('/categories/' . $category->id . '/edit')
            ->see('Categories <small>Edit</small>')
            ->type($name, 'name')
            ->press('Update')
            ->see('Category Updated!')
            ->seeInDatabase('categories', [
                'name' => $name
            ]);
    }

    /** @test */
    public function it_deletes_a_category()
    {
        $category = factory(\App\Category::class)->create();

        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->visit('/categories')
            ->see('Categories <small>Index</small>')
            ->see($category->name)
            ->press('category_' . $category->id)
            ->see('Category Deleted!')
            ->dontSee($category->name);
    }
}
