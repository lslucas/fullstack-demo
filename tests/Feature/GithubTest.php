<?php

namespace Tests\Feature;

use Tests\PassportTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GithubTest extends PassportTestCase
{
    /**
     * Test if our github wrapper is listing users.
     *
     * @return void
     */
    public function testUserList()
    {
        $this->json('GET', 'api/github/users')
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'data'
            ]);
    }

    /**
     * Test if our github wrapper is listing a user detail.
     *
     * @return void
     */
    public function testUserDetail()
    {
        $this->json('GET', 'api/github/users/lslucas')
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'data'
            ]);
    }

    /**
     * Test if our github wrapper is listing a user repos.
     *
     * @return void
     */
    public function testUserRepos()
    {
        $this->json('GET', 'api/github/users/lslucas/repos')
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'data'
            ]);
    }

}
