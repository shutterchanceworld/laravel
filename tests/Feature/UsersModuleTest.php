<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns;


class UsersModuleTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function it_shows_the_users_list()
    {
        factory(User::class)->create([
            'name' => 'Hiro',
        ]);

        factory(User::class)->create([
            'name' => 'Miu',
        ]);


        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('Users')
            ->assertSee('Hiro')
            ->assertSee('Miu');
    }

    /** @test */
    public function it_a_default_message_if_the_users_list_is_empty()
    {
        $this->get('/users?empty')
            ->assertStatus(200)
            ->assertSee('No registered users.');
            
    }

    /** @test */
    public function it_display_the_user_details() 
     //it_loads_the_users_details_pages()
    {
        $user = factory(User::class)->create([
            'name' => 'Hiroaki Takeshima'
        ]);

        $this->get('/users/details/'.$user->id)  //user/5
            ->assertStatus(200)
            ->assertSee('Hiroaki Takeshima');

    }

    /** @test */
    public function it_display_a_404_error_if_the_user_is_not_found()
    {
        $this->get('users/details/1000')
            ->assertStatus(404)
            ->assertSee('Page not found');
    }   

    /** @test */
    public function it_loads_the_new_user_page()
    {

        $this->withoutExceptionHandling();
        
        $this->get('/users/new')
            ->assertStatus(200)
            ->assertSee('Create new user');

    }

    /** @test */
    public function it_creates_a_new_user()
    {

        $this->withoutExceptionHandling();

        $this->post('/users/',[
            'name' => 'Hiro',
            'email' => 'bbb@bbb.com',
            'password' => '1234567',

         ])->assertRedirect('users');
        


        $this->assertCredentials([
            'name' => 'Hiro',
            'email' => 'bbb@bbb.com',
            'password' => '1234567',
           
        ]);
    }

     /** @test */
    public function the_name_is_required()
    {

        //$this->withoutExceptionHandling();


        $this->from('users/new')
            ->post('/users/',[
                'name' => '',
                'email' => 'bbb@bbb.com',
                'password' => '1234567',
            ])    
            ->assertRedirect('users/new')
            ->assertSessionHasErrors(['name' => 'The name field is required']);

        $this->assertEquals(0, User::count());
        // $this->assertDatabaseMissing('users',[
        //     'email' => 'bbb@bbb.com'
        // ]);    
        

    }    

     /** @test */
    public function the_email_is_required()
    {
        //$this->withoutExceptionHandling();

        $this->from('users/new')
            ->post('/users/',[
                'name' => 'Hiro',
                'email' => '',
                'password' => '1234567',
            ])    
            ->assertRedirect('users/new')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
        

    }    

     /** @test */
    public function the_email_must_be_valid()
    {

        $this->from('users/new')
            ->post('/users/',[
                'name' => 'Hiro',
                'email' => 'email-not-valid',
                'password' => '1234567',
            ])    
            ->assertRedirect('users/new')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
        

    }    

     /** @test */
    public function the_email_must_be_unique()
    {
        factory(User::class)->create([
            'email' => 'bbb@bbb.com'
        ]);

        $this->from('users/new')
            ->post('/users/',[
                'name' => 'Hiro',
                'email' => 'bbb@bbb.com',
                'password' => '1234567',
            ])    
            ->assertRedirect('users/new')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
        

    }    

     /** @test */
    public function the_password_is_required()
    {

        $this->from('users/new')
            ->post('/users/',[
                'name' => 'Hiro',
                'email' => 'bbb@bbb.com',
                'password' => '',
            ])    
            ->assertRedirect('users/new')
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
        

    }  

    /** @test */
    public function it_loads_the_edit_user_page()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        
        $this->get("/users/details/{$user->id}/edit")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('User editor')
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id === $user->id;
            });

    }

    /** @test */
    public function it_updates_a_user()
    {

        $user = factory(User::class)->create();

        $this->withoutExceptionHandling();

        $this->put("/users/details/{$user->id}",[
            'name' => 'Hiro',
            'email' => 'bbb@bbb.com',
            'password' => '1234567',

         ])->assertRedirect("/users/details/{$user->id}");

        $this->assertCredentials([
            'name' => 'Hiro',
            'email' => 'bbb@bbb.com',
            'password' => '1234567',
           
        ]);
    }

    /** @test */
    public function the_name_is_required_when_updating_the_user()
    {

        $user = factory(User::class)->create();

        $this->from("users/details/{$user->id}/edit")
             ->put("users/details/{$user->id}" ,[
                'name' => '',
                'email' => 'bbb@bbb.com',
                'password' => '1234567',
            ])    
            ->assertRedirect("users/details/{$user->id}/edit")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users',['email' => 'bbb@bbb.com']);
       

    } 


     /** @test */
    public function the_email_must_be_valid_when_updating_the_user()
    {

        $user = factory(User::class)->create();

        $this->from("users/details/{$user->id}/edit")
             ->put("users/details/{$user->id}" ,[
                'name' => 'Hiro',
                'email' => 'mail-not-valid',
                'password' => '1234567',
            ])    
            ->assertRedirect("users/details/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users',['name' => 'Hiro']);    

    }    

     /** @test */
    public function the_email_must_be_unique_when_updating_the_user()
    {
        self::markTestIncomplete();
        return;


        $user = factory(User::class)->create([
            'email' => 'bbb@bbb.com'
        ]);

        $this->from("users/details/{$user->id}/edit")
            ->put("users/details/{$user->id}",[
                'name' => 'Hiro',
                'email' => 'bbb@bbb.com',
                'password' => '1234567',
            ])    
            ->assertRedirect('users/new')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
        

    }    

     /** @test */
    public function the_password_is_optional_when_updating_the_user()
    {
        $oldpassword = 'oldpass';

        $user = factory(User::class)->create([
            'password' => bcrypt($oldpassword)
        ]);

        $this->from("users/details/{$user->id}")
            ->put("users/details/{$user->id}",[
                'name' => 'Hiro',
                'email' => 'bbb@bbb.com',
                'password' => '',
            ])    
            ->assertRedirect("users/details/{$user->id}");

        $this->assertCredentials([
            'name' => 'Hiro',
            'email' => 'bbb@bbb.com',
            'password' => $oldpassword
        ]);  
        

    }  


}
