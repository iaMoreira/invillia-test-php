<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonTest extends TestCase
{
    use DatabaseMigrations;
  
    //Test the display all routes
    public function testAll()
    {
        factory(Person::class, 5)->create();
        
        $response = $this->withAuthenticate()->getJson('/api/people');
        $response
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
                "code" => 200,
                "data" => [],
                "pagination" => []
            ]);
        $this->assertEquals(5, count($response->json()['data']));
    }
   
    //Test the single show route
    public function testShow()
    {
        $person = factory(Person::class)->create();

        $response = $this->withAuthenticate()
            ->getJson('/api/people/' . $person->id);
        $response->assertStatus(200);
        //Assert title is correct
        $this->assertEquals($person->name, $response->json()['data']['name']);
    }
    
}
