<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormularioInscripcionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // Asegúrate de que el usuario esté autorizado para hacer esta solicitud
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'Documento' => 'required',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'fecha_matricula' => 'required|date',
            'estado' => 'required|string',
            'nota_final' => 'required|numeric',
            'teacher_id' => 'required|exists:teachers,id',  // Asegúrate de que teacher_id existe
            'grupo_id' => 'required|exists:grupos,id',      // Asegúrate de que grupo_id existe
        ];
    }
}

