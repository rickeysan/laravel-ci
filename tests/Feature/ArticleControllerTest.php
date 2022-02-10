<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('articles.index'));

        // $response->assertStatus(200)->assertViewIs('articles.index');
        $response->assertStatus(400)->assertViewIs('articles.index');
    }
    public function testGuestCreate(){
        $response = $this->get(route('articles.create'));

        $response->assertRedirect(('login'));
    }
    public function testAuthCreate(){
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('articles.create'));

        $response->assertStatus(200)->assertViewIs('articles.create');
    }
}
