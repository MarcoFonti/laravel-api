<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateTechnologyRequest extends FormRequest
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

        /* RECUPERO IL VALORE DELLA ROTTA */
        $technology = $this->route('technology');

        /* RESTITUISCO CIO' CHE DA ERRORE */
        return [
            'label' => ['required', 'string', Rule::unique('types')->ignore($technology->id)],
            'color' => 'required',
        ];
    }

    public function messages(): array
    {
        /* RESTITUISCO CIO' CHE DARA' IL MESSAGGIO DI ERRORE */
        return [
            'label.required' => 'Il nome inserito nella tecnologia non esiste',
            'label.unique' => "Esiste già questo Tecnologia",
            'color.required' => 'Codice colore non valido',
        ];
    }
}