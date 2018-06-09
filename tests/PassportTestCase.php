<?php

namespace Tests;

use Fotec\Users\Models\User;
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
