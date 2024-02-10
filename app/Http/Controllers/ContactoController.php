<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactoMaillabe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    //


    public function pintarFormulario(){

        return view('contactoform.formulario');

    }



    public function procesarFormulario(Request $request){

        $request -> validate([

            'nombre' => ['required' , 'string' , 'min:4'],
            'email' => ['required' , 'email'],
            'contenido' => ['required' , 'string' , 'min:10']
        ]);

        //todo Hacemos un bloque try cathch por si algo falla capturar el error

        try {
            Mail::to('sergio@example.com') -> send(new ContactoMaillabe(ucwords($request -> nombre) , $request -> email , ucwords($request -> contenido)));
            return redirect() -> route('') -> with('mensaje' , "Correo enviado correctamente");
        } catch (\Exception $ex) {
            dd("Error en procesarFormulario") . $ex -> getMessage();
            return redirect() -> route('home') -> with('mensaje' , "Correo no enviado correctamente");
        }

    }

}
