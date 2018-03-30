<?php

namespace Tests\Browser\Login;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ForgotPasswordTest extends DuskTestCase
{
    public function testLinkAndRouteToPasswordRecovery()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Forgot Your Password?')
                ->click('@forgot-password-link')
                ->assertPathIs('/password/reset')
                ->visit('/login')
                ->visit('/password/reset')
                ->assertPathIs('/password/reset');
        });
    }

    public function testUnsuccessfulPasswordResetRequest()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/password/reset')
                ->assertVisible('#email')
                ->click('@password-reset-button')
                ->assertSee('The email field is required')
                ->type('#email', 'foo@bar.com')
                ->click('@password-reset-button')
                ->assertSee("We can't find a user with that e-mail address");
        });
    }

    public function testSuccessfulPasswordResetRequest()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/password/reset')
                ->type('#email', 'morkhus@gmail.com')
                ->click('@password-reset-button')
                ->assertSee('We have e-mailed your password reset link!');
        });
    }
}
