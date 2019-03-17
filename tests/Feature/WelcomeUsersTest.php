<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /** @test **/
    public function it_welcome_users_with_nickname()
    {
        $this->get('/greeting/Hiroaki/Hiro')
            ->assertStatus(200)
            ->assertSee('Welcome Hiroaki, your nickname is Hiro');

        $this->get('/greeting/Hiroaki')
            ->assertStatus(200)
            ->assertSee("Welcome Hiroaki, you don't have nickname");    
    }
}
