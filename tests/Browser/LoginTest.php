<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * Test if page is ok.
     *
     * @return void
     */
    public function testPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('E-Mail Address');
        });
    }

    /**
     * Test we can login.
     *
     * @return void
     */
    public function testLoginAction()
    {
        $user = factory(\App\User::class)->create([
            'password' => bcrypt('test')
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'test')
                    ->press('Login')
                    ->waitForLocation('/oauth/authorize')
                    ->press('Authorize')
                    ->waitForLocation('/home')
                    ->assertSee('Dashboard');
        });
    }

}
