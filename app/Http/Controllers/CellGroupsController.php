<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CellGroup as CellGroupResource;
use Symfony\Component\HttpFoundation\Response;
use App\CellGroup;
use App\Member;


class CellGroupsController extends Controller
{
    //

    public function index(){

        $this->authorize('viewAny', CellGroup::class);
        return CellGroupResource::collection(request()->user()->cellgroups);
    
    }
}
