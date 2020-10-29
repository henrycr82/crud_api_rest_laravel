<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//use Illuminate\Validation\Rule;

class UpdateDirectorioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // para obtener el id del directorio que lleva por la url
        //dd($this->route('directorio')->id);

        //$this->route('directorio')->id
        //Para que actualice todos los campos de un ID en específico y omita la 
        //validar el campo de 'telefono' (único) para un mismo ID.
        //Se validará que el campo 'telefono' sea contra los demas registros de la BD
        return [
            'nombre' => 'required|min:5|max:100',
            'telefono' => 'required|unique:directorios,telefono,'.$this->route('directorio')->id
        ];
    }
}