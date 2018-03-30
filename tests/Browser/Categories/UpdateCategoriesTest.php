<?php

namespace Tests\Browser\Categories;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateCategoriesTest extends DuskTestCase
{
    public function testUpdateCategoryFlow()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('#email','morkhus@gmail.com')
                ->type('#password', '123123')
                ->click('@login-button')
                ->pause(1000)
                ->visit('/categories')
                ->assertSee('Guitar')
                ->assertVisible('#update-category-7')
                ->click('#update-category-7')
                ->assertPathIs('/categories/edit/7')
                ->assertValue('#name', 'Guitar')
                ->click('@back-button')
                ->assertPathIs('/categories');
        });
    }

    public function testUnsuccessfulUpdateProcess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/categories/edit/5')
                ->click('@update-category-button')
                ->assertSee('The name has already been taken')
                ->clear('#name')
                ->click('@update-category-button')
                ->assertSee('The name field is required')
                ->clear('#name')
                ->type('#name', 'asd')
                ->click('@update-category-button')
                ->assertSee('The name must be at least 4 characters');
        });
    }

    public function testSucessfulUpdateProcess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/categories/edit/5')
                ->assertValue('#name', 'Violin')
                ->clear('#name')
                ->type('#name', 'Acoustic Guitar')
                ->click('@update-category-button')
                ->assertPathIs('/categories')
                ->assertSee('Category was successfully updated')
                ->assertSee('Acoustic Guitar');
        });
    }
}
