<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
    
use Illuminate\Support\Facades\Storage; // nos da acceso al espacio de almacenamiento
use Illuminate\Support\Facades\File; // permite accder a la carpeta temporal y a su vez a los arhivos 

class UserController extends Controller
{
    

    public function config(){

        return(view('user.config'));
    }

    public function update(Request $request){
        try {
            $user = \Auth::user(); // Guarda el objeto user autenticado
            // Validacion de datos 
            $validate = $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                // usamos el id para validar que el dato  puede ser igual al que ya tiene el usuario con ese id, ya que es de tipo unique!
                'nick' => 'required|string|max:255|unique:users,nick,'.$user->id, 
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            ]);
            // Recogemos datos del formulario y los asignamos en el objeto del usuario que ya esta autenicado
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->email = $request->input('email');
            $user->nick = $request->input('nick');
            $user->update();
            // Ejecucion de Query update

            return redirect('/config')->with('message', 'Datos Actualizados');
        } catch (\Throwable $th) {
            return redirect('/config')->with('error', 'Lo sentimos, Ah ocurrido un error');
        }
    }

    
    public function updatePhotoProfile(Request $request){
        try {
            // obtiene el objeto del usuario autenticado 
            $user = \Auth::user();
            // verifica si se recibe la imagen en el formulario 
            if($request->file('image')){
                // almacena el archivo enviado del formulario con name='image'
                $image = $request->file('image');
                /*
                    le damos el nombre al archivo que se recibe usando funcion time() y por medio del objeto almacenado
                    $image obtenemos la extencion del archivo con getClientOriginalExtension() y lo concatenamos 
                */
                $image_full = time().'.'.$image->getClientOriginalExtension();
                // almacenamos el espacio users con funcion storage y funcion put
                /*
                    function put()
                    Params
                        @image_full -> nombre que se le va asignar a la imagen a guardar
                        @content -> objeto alcaneado temporalmente en de la clase File  -> import "File"
                */
                // import Storage 
                Storage::disk('users')->put($image_full, File::get($image));
                // asignamos el nuevo valor a la propiedad image con el nombre nuevo 
                $user->image = $image_full;
                // actualizamos los datos en BD 
                $user->update();
                // si todo se realiza con exito retornamos mensaje de exito
                return redirect('/config')->with('message', 'Imagen Actualizada...');
            }
        } catch (\Throwable $th) {
            // si existe un error se retorna mensaje de error
            return redirect('/config')->with('error', 'Lo sentimos, Ah ocurrido un error!');
        }

    }

    /*
        Route::get('/user/avatar/{filename}', 'UserController@getImageProfile')->name('user.get_avatar');
        @ filename: nombre de la imagen que se busca dentro del Storage 
        -> retorna el string para usar en la vista y mostrar imagen
    */
    public function getImageProfile($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
        /*
            return response('Hello World', 200)
                ->header('Content-Type', 'text/plain');
        */
    }
}
