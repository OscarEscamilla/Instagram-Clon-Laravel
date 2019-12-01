<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commet extends Model
{
    //
    protected $table = 'comments';



    //relacion de muhcos a uno
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }



    //relacion de muhcos a uno
    public function image(){
        return $this->belongsTo('App\Image', 'image_id');
    }

}
