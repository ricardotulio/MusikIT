<?php

namespace Tests\Browser\Categories;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateCategoriesTest extends DuskTestCase
{
    public function testCreationRoutesAndActions()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('#email','morkhus@gmail.com')
                ->type('#password', '123123')
                ->click('@login-button')
                ->pause(1000)
                ->visit('/categories')
                ->assertPathIs('/categories')
                ->click('@add-category-button')
                ->assertPathIs('/categories/create')
                ->assertVisible('#name')
                ->assertVisible('@back-button')
                ->assertVisible('@create-category-button')
                ->click('@back-button')
                ->assertPathIs('/categories');
        });
    }

    public function testUnsuccessfulCreationProcess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/categories/create')
                ->type('#name', 'Violin')
                ->click('@create-category-button')
                ->assertSee('The name has already been taken')
                ->click('@create-category-button')
                ->assertSee('The name field is required')
                ->type('#name', 'asd')
                ->click('@create-category-button')
                ->assertSee('The name must be at least 4 characters');
        });
    }

    public function testSuccessfulCreationProcess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/categories/create')
                ->type('#name', 'Guitar')
                ->click('@create-category-button')
                ->assertSee('Category created successfully')
                ->assertPathIs('/categories/create')
                ->visit('/categories')
                ->assertSee('Guitar');
        });
    }
}
