<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* RECUPERO  I PROGETTI PUBBLICATI */
        $projects = Project::where('is_published', 1)->with('type', 'technologies')->get();

        /* CICLO SUI PROGETTI */
        foreach ($projects as $project) {
            /* SE CE UNA IMMAGINE */
            if($project->image) {
                /* RIASSE L'IMMAGINE CON URL E DIVENTA ASSOLUTO */
                $project->image = url('storage/' . $project->image);
            }
        }

        /* RESTITUISCO I PROGETTI IN FOTRMATO JSON */
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        /* CREO UNA QUERY CHE RECUPERA SOLO I PROGETTI PUBBLICATI E RECUPERO ANCHE LO SLUG */
        $project = Project::whereIsPublished(1)->whereSlug($slug)->with('type', 'technologies')->first();

        /* SE NON ESISTONO PROGETTI CREO MESSAGGIO NULLO E CODICE 404*/
        if(!$project){
            return response(null, 404);
        }
        
        /* RESTITUISCO IL PROGETTO IN FOTRMATO JSON */
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}