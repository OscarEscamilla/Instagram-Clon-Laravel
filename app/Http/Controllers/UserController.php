<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function config(){

        return(view('user.config'));
    }

    public function update(Request $req){

        $user = \Auth::user();
        var_dump($user);
        die();

        $validate = $req->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

      
        $name = $req->input('name');
        $surname = $req->input('surname');
        $nick = $req->input('nick');
        $email = $req->input('email');

        
        var_dump($id);
        var_dump($name);
        var_dump($surname);

        
    }
}
