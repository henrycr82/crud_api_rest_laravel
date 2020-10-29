<?php

namespace App\Http\Controllers;

//importamos el módelo directorio
use App\Directorio;
//importamos los Request dónde están las validaciones de campos
use App\Http\Requests\CreateDirectorioRequest;
use App\Http\Requests\UpdateDirectorioRequest;

use Illuminate\Http\Request;

class DirectorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Get listar directorios
    //$request me trae los parametros de busqueda que paso por la url
    public function index(Request $request)
    {
        //todo lo que me llega via $request
        //dd($request->all());
        
        //si encuentro la palabra buscar en la url que me llega via $request
        if ($request->has('buscar')) {
            //realizo busquedas por los campos (nombre, direccion y telefono)
           $directorios = Directorio::where('nombre', 'like', '%'.$request->buscar.'%')
                            ->orWhere('direccion', 'like', '%'.$request->buscar.'%')
                            ->orWhere('telefono', $request->buscar)
                            ->get();
        }
        //caso contrario retorno todos directorios
        else
        {
            $directorios = Directorio::all();
        }
    
        return $directorios;
    }

    public function cargarArchivo($file)
    {
        //armamos el nombre del archivo
        //para obtener la extención del archivo getClientOriginalExtension()
        $nombreArchivo = time(). '.'. $file->getClientOriginalExtension();

        //movemos el archivo al folder public/fotografias
        $file->move(public_path('fotografias'), $nombreArchivo);

        return $nombreArchivo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //POST insertar directorios
    //CreateDirectorioRequest para las validaciones de los campos
    public function store(CreateDirectorioRequest $request)
    {
        //todo los campos que me llegan via $request
        $input = $request->all();

        //si llega via $request el parametro foto
        if($request->has('foto')) {
            $input['foto'] = $this->cargarArchivo($request->foto);
        }

        //almaceno
        Directorio::create($input);
        
        //retorno una respuesta json
        return response()->json([
            'res' => true,
            'message' => 'Registro almacenado satisfactoriamente'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //(Directorio $directorio) esto se puede hacer a partir de laravel 6
    //Directorio módelo directorio; $directorio = id del directorio que vamos a buscar
    //Get para retornar un solo directorio por id
    public function show(Directorio $directorio)
    {
        return $directorio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Directorio módelo directorio; $directorio = id del directorio que vamos a buscar
    //PUT actualizar directorios
    //UpdateDirectorioRequest para las validaciones de los campos
    public function update(UpdateDirectorioRequest $request, Directorio $directorio)
    {
        //todo los campos que me llegan via $request
        $input = $request->all();

        //si llega via $request el parametro foto
        if($request->has('foto')) {
            $input['foto'] = $this->cargarArchivo($request->foto);
        }
        
        //actualizo
        $directorio->update($input);

        //retorno una respuesta json
        return response()->json([
            'res' => true,
            'message' => 'Registro modificado satisfactoriamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //DELETE eliminar registros
    public function destroy($id)
    {
        //elimino
        Directorio::destroy($id);
        //retorno una respuesta json
        return response()->json([
            'res' => true,
            'message' => 'Registro eliminado satisfactoriamente'
        ], 200);

    }
}
