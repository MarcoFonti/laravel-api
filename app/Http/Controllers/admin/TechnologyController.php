<?php

namespace App\Http\Controllers\admin;

use App\Models\Technology;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* RECUPERO TUTTE LE TECNOLOGIE */
        $technologies = Technology::all();

        /* RETURN NELLA STESSA PAGINA */
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* RETURN NELLA STESSA PAGINA */
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        /* RECUPERO VALIDAZIONE */
        $data = $request->validated();

        /* CREO NUOVA ISTANZA */
        $technology = new Technology();

        /* DATI VALIDATI */
        $technology->fill($data);

        /* SALVATAGGIO */
        $technology->save();

        /* RETURN SULLA INDEX E CREO MESSAGGIO ALERT */
        return to_route('admin.technologies.index')->with('type', 'success')->with('message', 'Tecnologia Salvata');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        /* RETURN NELLA STESSA PAGINA */
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        /* RETURN NELLA STESSA PAGINA */
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
         /* RECUPERO VALIDAZIONE */
         $data = $request->validated();

         /* SALVATAGGIO */
         $technology->update($data);
 
         /* RETURN SULLA INDEX E CREO MESSAGGIO ALERT */
         return to_route('admin.technologies.index')->with('type', 'info')->with('message', "Tecnologia aggiornata");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        /* ELIMINI ELEMENTO */
        $technology->delete();

        /* RETURN SULLA INDEX E CREO ALERT */
        return to_route('admin.technologies.index')->with('type', 'danger')->with('message', "Tecnologia eliminata");
    }
}