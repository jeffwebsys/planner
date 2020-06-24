<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CellGroup extends Model
{
    //


    public function user(){

        return $this->belongsTo(User::class);
    }

    public function member(){

        return $this->belongsTo(Member::class);
    }
    
    public function path(){

        return '/cellgroups/' . $this->id;
    }


}
