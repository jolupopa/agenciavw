<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TypepropertyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Aquí está la clave: validamos que no exista otro 'name'
                // que, al convertirlo a minúsculas, sea igual al que se está enviando.
                // Esto es útil si quieres que el usuario perciba el nombre como único,
                // incluso si el slug lo diferenciará internamente.
                Rule::unique('typeproperties', 'name')
                ->where(function ($query) {
                    $query->whereRaw('LOWER(name) = ?', [strtolower($this->name)]);
                })
                 ->ignore($this->typeproperty ? $this->typeproperty->id : null),
             
            ],
            'active' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del tipo de propiedad es obligatorio',
            'name.unique' => 'Este tipo de propiedad ya existe',
            'active.required' => 'El campo activa es obligatorio',
            'active.boolean' => 'El campo activa debe ser verdadero o falso',

        ];
    }
}
