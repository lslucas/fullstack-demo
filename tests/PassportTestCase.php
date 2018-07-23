<?php

namespace Tests;

use App\User;
use Laravel\Passport\Passport;

abstract class PassportTestCase extends TestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();

        Passport::actingAs(
            factory(User::class)->create(),
            ['*']
        );
    }

}
