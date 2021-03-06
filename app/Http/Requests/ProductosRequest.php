<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductosRequest extends FormRequest
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
            'nombre'=>'required|min:4',
            'descripcion'=>'required',
            'stock'=>'required|numeric|min:0',
            'precio'=>'required',
            'subcategoria'=>'required',
            'imagen'=>'required'
        ];
    }
}
