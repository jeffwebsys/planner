<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Member as MemberResource;
use Symfony\Component\HttpFoundation\Response;
use App\Member;


class MembersController extends Controller
{
    //

    public function index(){

    $this->authorize('viewAny', Member::class);

    return MemberResource::collection(request()->user()->members);


    }
    public function store(){

        $this->authorize('create', Member::class);
        

        $member = request()->user()->members()->create($this->validateData());

       return (new MemberResource($member))
       ->response()
       ->setStatusCode(Response::HTTP_CREATED);
    }
    public function show(Member $member){

        // if(request()->user()->isNot($contact->user)){

        //     return response([], 403);
        // }
        $this->authorize('view', $member);

        return new MemberResource($member);

}

public function update(Member $member){
    

    $this->authorize('update', $member);


    $member->update($this->validateData());
    return (new MemberResource($member))
       ->response()
       ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Member $member){

        // if(request()->user()->isNot($member->user)){
    
        //     return response([], 403);
        // }
        $this->authorize('delete', $member);
    
    
        $member->delete();
        return response([], Response::HTTP_NO_CONTENT);
    
    }





// data will be added here
    private function validateData(){

        return request()->validate([
    
            'name' => 'required',
            'email' => 'required|email',
            'birthday' => 'required',
            'company' => 'required',
            'position' => 'required',
            'location' => 'required',
            'offerings' => 'required',
    
        ]);
    }


// end of class
}
