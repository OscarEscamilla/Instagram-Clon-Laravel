<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
    
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function config(){

        return(view('user.config'));
    }

    public function update(Request $req){
        try {
            $user = \Auth::user(); // Guarda el objeto user autenticado
            // Validacion de datos 
            $validate = $req->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                // usamos el id para validar que el dato  puede ser igual al que ya tiene el usuario con ese id, ya que es de tipo unique!
                'nick' => 'required|string|max:255|unique:users,nick,'.$user->id, 
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            ]);
            // Recogemos datos del formulario y los asignamos en el objeto del usuario que ya esta autenicado
            $user->name = $req->input('name');
            $user->surname = $req->input('surname');
            $user->nick = $req->input('nick');
            $user->email = $req->input('email');
            // Ejecucion de Query update
            $user->update();

            return redirect('/config')->with('message', 'Datos Actualizados');
        } catch (\Throwable $th) {
            return redirect('/config')->with('error', 'Lo sentimos, Ah ocurrido un error');
        }
    }


    public function updatePhoto(Request $req){
        $image = $req->file('image');
        if($image){

        }
    }
}
