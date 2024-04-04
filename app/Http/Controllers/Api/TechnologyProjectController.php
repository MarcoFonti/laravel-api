<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyProjectController extends Controller
{
    public function __invoke(string $slug)
    {
        /* FILTRO NELLA TABELLA TECHNOLOGIES IL RECORD CORRISPONDENDE E RESTITUTISCO IL SUO PROMO VALORE */
        $technology = Technology::where('slug', $slug)->first();

        /* SE NON ESISTONO TECNOLOGIE CREO MESSAGGIO NULLO E CODICE 404*/
        if (!$technology) {
            return response(null, 404);
        }

        /* RESTITUISCO UN FILTRO PER I PROGETTI PUBBLICATI, RELAZIONE MOLTI A MOLTI DOVE VERIFICO SE ESISTONO RECORD CORRELATI TRA LE DUE TABELLE E CERCO PER ID SPECIFICO */
        $projects = Project::where('is_published', 1)->whereHas('technologies', function($query) use ($technology){
            $query->where('technologies.id', $technology->id);
        })->with('type', 'technologies')->get();

        /* RESTITUISCO IL PROGETTO IN FOTRMATO JSON */
        return response()->json(['projects' => $projects, 'label' => $technology->label]);
    }
}