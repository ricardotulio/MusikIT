<?php

namespace Tests\Browser\Login;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    public function testOnEmptyFieldsErrorMessageShouldBeShown()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertPathIs('/login')
                ->assertVisible('#email')
                ->assertVisible('#password')
                ->assertVisible('@login-button')
                ->click('@login-button')
                ->assertSee('The email field is required')
                ->assertSee('The password field is required');
        });
    }

    public function testShouldSuccessfullyLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                ->pause(1000)
                ->assertPathIs('/login')
                ->type('email', 'morkhus@gmail.com')
                ->type('password', '123123')
                ->click('@login-button')
                ->assertPathIs('/home')
                ->assertSee('Morkhusz');
        });
    }

    public function testUserShouldBeAbleToLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1600, 1080)
                ->click('#navbarDropdown')
                ->assertSee('Logout')
                ->click('@logout-link')
                ->assertPathIs('/')
                ->assertSee('LOGIN')
                ->assertSee('REGISTER');
        });
    }
}