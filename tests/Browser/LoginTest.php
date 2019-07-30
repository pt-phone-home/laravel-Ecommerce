<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{

    use DatabaseMigrations;

    public function test_a_user_cannot_login_with_incorrect_details()
    {
        $user = factory(User::class)->create([
            'email' => 'user@user.com',
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->visit('/login')
                ->assertSee('Login')
                ->type('email', 'user@user.com')
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/login');
        });
    }
    public function testAUserCanLogin_with_credentials()
    {

        // Arrange

        $user = factory(User::class)->create([
            'email' => 'user@user.com',
            'password' => Hash::make('password')
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->visit('/login')
                ->assertSee('Login')
                ->type('email', 'user@user.com')
                ->type('password', 'password')
                ->press('Login')
                ->assertPathIs('/');
        });
    }
}