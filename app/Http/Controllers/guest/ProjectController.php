<?php

namespace App\Http\Controllers\guest;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /* RECUPERI VALORE DELLA QUERY */
        $search = $request->query('search');
        
        /* RESTUTIISCO UNA QUERY CON FILTRO PER RICERCA E SE IL PROGETTO E' PUBBLICATO */
        $projects = Project::where('title', 'LIKE', "%$search%")
        ->where('is_published', true)
        ->get();
        
        /* RETURN NELLA STESSA PAGINA */
        return view('guest.projects.index', compact('projects', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(String $slug)
    {
        /* RECUPERO IL PROGETTO CORRISPONDENDE CON LO SLUG */
        $project = Project::whereSlug($slug)->first();

        /* SE NON CE UN PROGETTO */
        if(!$project) {
            abort(404);
        }
        
        /* RETURN NELLA STESSA PAGINA */
        return view('guest.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}