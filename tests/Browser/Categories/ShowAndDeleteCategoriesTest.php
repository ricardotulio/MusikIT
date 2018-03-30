<?php

namespace Tests\Browser\Categories;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ShowAndDeleteCategoriesTest extends DuskTestCase
{
    public function testShowCategoriesOnlyIfAuthed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/categories')
                ->pause(1000)
                ->assertPathIs('/login');
        });
    }

    public function testCheckIfCategoriesAndActionsAreShown()
    {
        $this->browse(function (Browser $browser) {
            $browser->type('#email','morkhus@gmail.com')
                ->type('#password', '123123')
                ->click('@login-button')
                ->pause(1000)
                ->visit('/categories')
                ->assertPathIs('/categories')
                ->assertVisible('@add-category-button')
                ->assertVisible('#categories-table')
                ->assertVisible('#delete-category-1')
                ->click('#delete-category-1')
                ->assertSee('The selected category was successfully deleted');
        });

    }
}
