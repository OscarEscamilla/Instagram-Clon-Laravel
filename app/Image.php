<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'images'; //nombre de la tabla que modifica este modelo


    //realcion uno a muchos
    //una imagen puede tener muchos commentarios

    //metodo para obtener los comentarios relacionados a la imagen
    public function comments(){
        //le decimos que va ocupar el id de el modelo Comment
        return $this->hasMany('App\Comment');
    }



    //realcion uno a muchos
    //una imagen puede tener muchos likes
    public function likes(){
        return $this->hasMany('App\Like');
    }


    //relacion de muhcos a uno
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
