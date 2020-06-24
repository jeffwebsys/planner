<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Member extends Model
{
    //
    protected $guarded = [];

    protected $dates = ['birthday'];


    public function user(){

        return $this->belongsTo(User::class);


    }
    public function cellgroups(){

        return $this->hasOne(CellGroup::class);


    }

    public function path(){

        return '/members/' . $this->id;
    }
}
