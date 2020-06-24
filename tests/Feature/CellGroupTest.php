<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Member;
use App\CellGroup;

class CellGroupTest extends TestCase
{

    use RefreshDatabase;
    protected $user;

    protected function setUp(): void {
    parent::setUp();
    $this->user = factory(User::class)->create();

}
    /** @test */
    public function a_list_of_cg_can_be_fetched_for_the_authenticated_user(){

    //  $this->withoutExceptionHandling();

     $user = factory(User::class)->create();
     $anotherUser = factory(User::class)->create();
 
     $cellgroup = factory(CellGroup::class)->create(['user_id' => $user->id]);
     $anothercellgroup = factory(CellGroup::class)->create(['user_id' => $anotherUser->id]);
 
     $response = $this->get('/api/cellgroups?api_token=' . $user->api_token);
     // dd(json_decode($response->getContent()));
 
     $response->assertJsonCount(1)->assertJson([
 
         'data' => [
 
             [
                 'data' => [ 
         
                     'cellgroup_id' => $cellgroup->id
                 ]
         
             ]
         ]
     ]);
 

    }
 /** @test */
 public function an_unauthenticated_user_should_redirected_to_login(){

    // $this->withoutExceptionHandling();


    $response = $this->post('/api/cellgroups', array_merge($this->data(),['api_token' => '']));
    
    $response->assertRedirect('/login');
    $this->assertCount(0, Cellgroup::all());
    } 



//data
    private function data(){

        return [
    
        'name' => 'Sea Of Galilee',
        'description' => 'This is SOG',
        'leader' => 'Patrick',
    
        ];
        }



} //end class
