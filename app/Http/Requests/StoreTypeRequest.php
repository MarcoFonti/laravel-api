<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreTypeRequest extends FormRequest
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

        /* RESTITUISCO CIO' CHE DA ERRORE */
        return [
            'label' => 'required|string|unique:types,id',
            'color' => 'required|hex_color',
        ];
    }

    public function messages(): array
    {

        /* RECUPERO TUTTO I DATI */
        $data = $this->all();
        
        /* RESTITUISCO CIO' CHE DARA' IL MESSAGGIO DI ERRORE */
        return [
            'label.required' => 'Il nome della categoria è obbligatorio',
            'label.unique' => "Esiste già questo categoria {$data['label']}",
            'color.hex_color' => 'Codice colore non valido',
        ];
    }
}