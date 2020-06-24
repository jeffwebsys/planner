<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\User;
use App\Member;
use Carbon\Carbon;


class MemberTest extends TestCase
{

    use RefreshDatabase;
    
protected $user;

protected function setUp(): void{
    parent::setUp();
$this->user = factory(User::class)->create();

}
    
    /** @test */
public function a_list_of_members_can_be_fetched_for_the_authenticated_user(){

    // $this->withoutExceptionHandling();

    $user = factory(User::class)->create();
    $anotherUser = factory(User::class)->create();

    $member = factory(Member::class)->create(['user_id' => $user->id]);
    $anotherMember = factory(Member::class)->create(['user_id' => $anotherUser->id]);

    $response = $this->get('/api/members?api_token=' . $user->api_token);
    // dd(json_decode($response->getContent()));

    $response->assertJsonCount(1)->assertJson([

        'data' => [

            [
                'data' => [ 
        
                    'member_id' => $member->id
                ]
        
            ]
        ]
    ]);

    }


    /** @test */
    public function an_unauthenticated_user_should_redirected_to_login(){

        // $this->withoutExceptionHandling();


        $response = $this->post('/api/members', array_merge($this->data(),['api_token' => '']));
        
        $response->assertRedirect('/login');
        $this->assertCount(0, Member::all());
        }

 /** @test */
 public function an_authenticated_user_can_add_a_member()
 {
 
//  $this->withoutExceptionHandling();
 
 $user = factory(User::class)->create();
 
 
 $response = $this->post('/api/members', $this->data());
 
 $member = Member::first();
 // dd(json_decode($response->getContent()));
 
 $this->assertEquals('Test Name', $member->name);
 $this->assertEquals('jeff@gmail.com', $member->email);
 $this->assertEquals('Web Developer', $member->position);
 $this->assertEquals('100', $member->offerings);
 $this->assertEquals('Pangasinan', $member->location);
 $this->assertInstanceOf(Carbon::class, Member::first()->birthday);
 $this->assertEquals('Oracle', $member->company);
 $response->assertStatus(Response::HTTP_CREATED);
 $response->assertJson([
 
 'data' => [
 
     'member_id' => $member->id,
 ],
 
 'links' => [
     'self' => '/members/' . $member->id,
 ]
 
 ]);
 
 
 
 }
 /** @test */
public function fields_are_required(){

    // $this->withoutExceptionHandling();
    collect(['name','email','birthday','company',
    'position','location','offerings'])->each(function ($field) {
    $response = $this->post('/api/members', 
    array_merge($this->data(), [$field => '']));

    $member = Member::all();

    $response->assertSessionHasErrors($field);
    $this->assertCount(0, $member);

    });
}

/** @test */
public function email_must_be_a_valid_email(){

    // $this->withoutExceptionHandling();
    $response = $this->post('/api/members', 
    array_merge($this->data(), ['email' => 'NOT AN EMAIL']));

    $member = Member::all();

    $response->assertSessionHasErrors('email');
    $this->assertCount(0, $member);

}
 /** @test */
public function birthdays_are_properly_stored(){
    // $this->withoutExceptionHandling();
    $response = $this->post('/api/members', 
    array_merge($this->data()));

  
    $this->assertCount(1, Member::all());
    $this->assertInstanceOf(Carbon::class, Member::first()->birthday);
    $this->assertEquals('09-24-1989', Member::first()->birthday->format('m-d-Y'));

}
/** @test */
public function a_member_can_be_retrieved(){

    // $this->withoutExceptionHandling();

    $member = factory(Member::class)->create(['user_id' => $this->user->id]);
  $response = $this->get('/api/members/'. $member->id . '?api_token=' . $this->user->api_token);
  
  $response->assertJson([

    'data' => [
    'member_id' => $member->id,
    'name' => $member->name,
    'email' => $member->email,
    'birthday' => $member->birthday->format('m/d/Y'),
    'company' => $member->company,
    'position' => $member->position,
    'location' => $member->location,
    'offerings' => $member->offerings,
    'last_updated' => $member->updated_at->diffForHumans(),

    ]
    
    ]);
}
/** @test */
public function only_the_users_members_can_be_retrieved(){

    $member = factory(Member::class)->create(['user_id' => $this->user->id]);
    $anotherUser = factory(User::class)->create();

    $response = $this->get('/api/members/'. $member->id . '?api_token=' . $anotherUser->api_token);
    $response->assertStatus(Response::HTTP_FORBIDDEN);
}

/** @test */
public function a_member_can_be_patched(){

    // $this->withoutExceptionHandling(); 

$member = factory(Member::class)->create(['user_id' => $this->user->id]);
$response = $this->patch('/api/members/'. $member->id, $this->data());
$member = $member->fresh();



$this->assertEquals('Test Name', $member->name);
$this->assertEquals('jeff@gmail.com', $member->email);
// $this->assertInstanceOf(Carbon::class, member::first()->birthday);
$this->assertEquals('09/24/1989', $member->birthday->format('m/d/Y'));
$this->assertEquals('Oracle', $member->company);
$this->assertEquals('Web Developer', $member->position);
$this->assertEquals('Pangasinan', $member->location);
$this->assertEquals('100', $member->offerings);



$response->assertStatus(Response::HTTP_OK);
$response->assertJson([

    'data' => [

        'member_id' => $member->id,
    ],
 
    'links' => [
        'self' => $member->path(),
    ]
]);

}
/** @test */
public function only_the_owner_of_the_member_can_patch_the_member(){

    $member = factory(Member::class)->create();
    $anotherUser = factory(User::class)->create();


  $response = $this->patch('/api/members/'. $member->id, array_merge($this->data(), ['api_token' => $anotherUser->api_token]));
  $response->assertStatus(Response::HTTP_FORBIDDEN);


}   
/** @test */
public function a_member_can_be_deleted(){

      $this->withoutExceptionHandling(); 

    $member = factory(Member::class)->create(['user_id' => $this->user->id]);

    $response = $this->delete('/api/members/'.$member->id, ['api_token' => $this->user->api_token]);
    $this->assertCount(0, member::all());
    $response->assertStatus(Response::HTTP_NO_CONTENT);
}

/** @test */
public function only_the_owner_can_delete_the_member(){

    $member = factory(Member::class)->create();
    $anotherUser = factory(User::class)->create();

    $response = $this->delete('/api/members/'.$member->id, ['api_token' => $this->user->api_token]);
   


    $response->assertStatus(Response::HTTP_FORBIDDEN);
}



// all added data will be here

    private function data(){

    return [

    'name' => 'Test Name',
    'email' => 'jeff@gmail.com',
    'birthday' => '09/24/1989',
    'company' => 'Oracle',
    'api_token' => $this->user->api_token,
    'position' => 'Web Developer',
    'location'=> 'Pangasinan',
    'offerings' => '100',

    ];
    }





}
