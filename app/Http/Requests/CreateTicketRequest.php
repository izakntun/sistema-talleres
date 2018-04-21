<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
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
        return [
            'ente_publico' => 'required',
            'prioridad' => 'required',
            'estatus' => 'required',
            'medio_consulta' => 'required',
            'categoria' => 'required',
            'folio' => 'max:50',
            'fecha_registro' => 'required',
            'asunto' => 'required',
            'descripcion' => 'required',
            'enlace' => 'required',
            'correo_electronico' => 'required|email',
            'telefono' => 'required',
        ];
    }
}
