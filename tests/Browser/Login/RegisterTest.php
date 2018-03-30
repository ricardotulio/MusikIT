<?php

namespace Tests\Browser\Login;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    public function testRegisterPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                ->resize(1600, 1080)
                ->assertVisible('@login-link')
                ->assertVisible('@register-link')
                ->click('@register-link')
                ->assertPathIs('/register')
                ->assertVisible('#name')
                ->assertVisible('#email')
                ->assertVisible('#password')
                ->assertVisible('#password-confirm')
                ->assertVisible('@register-button');
        });
    }

    public function testUnsuccessfulRegistration()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->click('@register-button')
                ->assertSee('The name field is required')
                ->assertSee('The email field is required')
                ->assertSee('The password field is required');
        });
    }

    public function testUnsuccessfulPasswordConfirmation()
    {
        $this->browse(function (Browser $browser) {
            $browser->type('#password', '123123')
                ->type('#password-confirm', '321321')
                ->click('@register-button')
                ->assertSee('The password confirmation does not match');
        });
    }

    public function testSuccessfulRegistration()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('#name', 'Morkhusz')
                ->type('#email', 'morkhus@gmail.com')
                ->type('#password', '123123')
                ->type('#password-confirm', '123123')
                ->click('@register-button')
                ->pause(1000)
                ->assertPathIs('/home')
                ->assertSee('Morkhusz' );

        });
    }
}
