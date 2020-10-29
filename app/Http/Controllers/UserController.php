<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request){

        $input = $request->all();

        //encriptamos el password
        $input['password'] = Hash::make($request->password);
        
        User::create($input);

        return response()->json([
            'res' => true,
            'message' => 'Usuario registrado exitosamente'
        ], 200);
   }
    
    public function login(Request $request)
    {
        //busco el usuario por email
        $user = User::whereEmail($request->email)->first();

        //si el usuario es distindo de nulo y su password coincide con el almacenado en la BD
        if (!is_null($user) && Hash::check($request->password, $user->password)) 
        {
            //$token = $user->createToken('Contactos')->accessToken;
            //$user->api_token = Str::random(100);
            //$user->save();

            // Creamos el token con el nombre de nuestra aplicación
            $token = $user->createToken('contactos')->accessToken;


            return response()->json([
                'res' => true, 
                'token' => $token,
                'message' => "Bienvenido al sistema"
            ], 200);
        } else {
            return response()->json([
                'res' => false, 
                'message' => "Cuenta a password incorrectos"
            ], 200);
        }
    }

    public function logout(){
        //Logueos del usurio
        $user = auth()->user();
        
        //Recorro los loguegos que pueda tener el usuario y elimino el token
        $user->tokens->each(function ($token, $key){
            $token->delete();
        });

        return response()->json(['res' => true, 'message' => "Adios"],200);
    }
}