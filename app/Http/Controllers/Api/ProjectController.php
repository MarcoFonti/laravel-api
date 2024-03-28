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
        $projects = Project::where('is_published', 1)->with('type')->get();

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
    public function show(Project $project)
    {
        //
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