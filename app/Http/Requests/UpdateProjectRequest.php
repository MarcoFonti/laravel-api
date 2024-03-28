<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
        $project = $this->route('project');
        
        /* RESTITUISCO CIO' CHE DA ERRORE */
        return [
            'title' =>['required', 'string','min:5','max:50', Rule::unique('projects')->ignore($project->id)],
            'content' => 'required|string',
            'image' => 'nullable|image',
            'is_published' => 'nullable|boolean',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ];
    }

    public function messages(): array 
    {

        /* RECUPERO TUTTO I DATI */
        $data = $this->all();
        
        /* RESTITUISCO CIO' CHE DARA' IL MESSAGGIO DI ERRORE */
        return [
            'title.required' => 'Il campo Titolo è obbligatorio',
            'title.min' => 'Il campo Titolo deve essere almeni :min caratteri',
            'title.max' => 'Il campo Titolo deve essere almeni :max caratteri',
            'title.unique' => "Esiste già questo nome {$data['title']}",
            'content.required' => 'Il contenuto è obbligatorio ',
            'image.image' => 'Il file inserito non è un\'immagine',
            'type_id.exists' => 'Categoria non valida',
            'technologies.exists' => "Tecnologie selezionate non valide",
        ];
    }
}