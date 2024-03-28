<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* RECUPERO TUTTE LE TIPOLOGIE */
        $types = Type::all();

        /* RETURN NELLA STESSA PAGINA */
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* RETURN NELLA STESSA PAGINA */
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        /* RECUPERO VALIDAZIONE */
        $data = $request->validated();

        /* CREO NUOVA ISTANZA */
        $type = new Type();

        /* DATI VALIDATI */
        $type->fill($data);

        /* SALVATAGGIO */
        $type->save();

        /* RETURN SULLA INDEX E CREO MESSAGGIO ALERT */
        return to_route('admin.types.index')->with('type', 'success')->with('message', "Categoria ( $type->label ) salvata");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        /* RETURN NELLA STESSA PAGINA */
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        /* RETURN NELLA STESSA PAGINA */
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        /* RECUPERO VALIDAZIONE */
        $data = $request->validated();

        /* SALVATAGGIO */
        $type->update($data);

        /* RETURN SULLA INDEX E CREO MESSAGGIO ALERT */
        return to_route('admin.types.index')->with('type', 'info')->with('message', "Categoria ( $type->label ) aggiornata");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        /* ELIMINI ELEMENTO */
        $type->delete();

        /* RETURN SULLA INDEX E CREO ALERT */
        return to_route('admin.types.index')->with('type', 'danger')->with('message', "Categoria ( $type->label ) eliminata");
    }
}