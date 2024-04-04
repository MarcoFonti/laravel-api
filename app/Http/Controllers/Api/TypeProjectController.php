<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeProjectController extends Controller
{
    public function __invoke(string $slug)
    {
        /* FILTRO NELLA TABELLA TYPE IL RECORD CORRISPONDENDE E RESTITUTISCO IL SUO PROMO VALORE */
        $type = Type::where('slug', $slug)->first();

        /* SE NON ESISTONO TIPOLOGIE CREO MESSAGGIO NULLO E CODICE 404*/
        if (!$type) {
            return response(null, 404);
        }

        /* FILTRO I RECORD DELLA TABELLA PROJECTS IN BASE ALL'ID TYPE, FILTRO ANCHE I RECORD PUBBLICI E MANDO GIU' ANCHE LE VARIE RELAZIONI */
        $projects = Project::where('type_id', $type->id)->where('is_published', 1)->with('technologies', 'type')->get();

        /* RESTITUISCO IL PROGETTO IN FOTRMATO JSON */
        return response()->json(['projects' => $projects, 'label' => $type->label]);
    }


}