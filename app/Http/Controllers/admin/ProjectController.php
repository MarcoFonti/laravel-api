<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        /* RECUPERI VALORE DELLA QUERY PER I PUBBLICATI E BOZZE */
        $filter = $request->query('filter');

        /* RECUPERI VALORE DELLA QUERY PER TIPOLOGIE */
        $type_filter = $request->query('type_filter');

        /* RECUPERI VALORE DELLA QUERY PER TECNOLOGIE */
        $technology_filter = $request->query('technology_filter');

        /* PREPARO LA QUERY DEL MODELLO IN ORDINE DESCRESCENTE MODIFICA E CREAZIONE */
        $query = Project::orderByDesc('updated_at')->orderByDesc('created_at');

        /* SE LA VARIABILE FILTER ESISTE ED E' UGUALE A PUBLISHED FILTRIAMO SOLO QUELLI PUBBLICATI */
        if ($filter) {
            $value = $filter === 'published';
            $query->whereIsPublished($value);
        }
        
        /* SE LA VARIABILE TYPE_FILTER ESISTE IN BASE AL VALORE ID FILTRA */
        if($type_filter) {
            $query->where('type_id', $type_filter);
        }

        /* SE LA VARIABILE TECHNOLOGY_FILTER ESISTE IN BASE AL VALORE ID FILTRA */
        if($technology_filter) {
            /* FILTRO I RISULTATI DELLA QUERY DELLA TABELLA PONTE */
            $query->whereHas('technologies', function($query) use ($technology_filter){
                /* CERCO ID CORRISPONDETE FILTRATO NELLA TABELLA TECHNOLOGIES */
                $query->where('technologies.id', $technology_filter);
            });
        }

        /* PAGINAZIONE A 10 ALLA VOLTA E MANTIENI LINK SULL'URL */
        $projects = $query->paginate(10)->withQueryString();

        /* RECUPERO TUTTE LE TIPOLOGIE */
        $types = Type::all();

        /* RECUPERO TUTTE LE TECNOLOGIE */
        $technologies = Technology::all();
        
        /* RETURN NELLA STESSA PAGINA */
        return view('admin.projects.index', compact('projects', 'filter', 'types', 'type_filter', 'technologies', 'technology_filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        /* RECUPERO SOLO CIO CHE MI SERVE DAL MODELLO TYPE */
        $types = Type::select('label', 'id')->get();
        
        /* RECUPERO SOLO CIO CHE MI SERVE DAL MODELLO TECHNOLOGY */
        $technologies = Technology::select('label', 'id')->get();
        
        /* RETURN NELLA STESSA PAGINA */
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        /* RECUPERO VALIDAZIONE */
        $data = $request->validated();

        /* CREO NUOVA ISTANZA */
        $project = new Project();

        /* DATI VALIDATI */
        $project->fill($data);

        /* SLUG */
        $project->slug = Str::slug($project->title);

        /* VERIFICO SE ESISTE NELL'ARRAY ASSOCIATIVO DATA LA CHIAVE IS_PUBLISHED */
        $project->is_published = array_key_exists('is_published', $data);

        /* VERIFICO SE ESISTE NELL'ARRAY ASSOCIATIVO DATA ARRIVA UN FILE */
        if (Arr::exists($data, 'image')) {

            /* RECUPERO JPG, PNG ETC.. */
            $url = $data['image']->extension();

            /* SALVO IL FILE IN UNA CARTELLA E PRENDO L'URL */
            $img_url = Storage::putFileAs('project_images', $data['image'], "$project->slug.$url");
            $project->image = $img_url;
        };

        /* SALVATAGGIO */
        $project->save();

        /* VERIFICO SE ESISTE NELL'ARRAY LA CHIAVE TECHNOLOGIIES, SE ESTISTE */
        if(Arr::exists($data, 'technologies')){
            /* ATTACCO I RECORD DEL PROGETTO AI RECORD DELLE TECNOLOGIE */
            $project->technologies()->attach($data['technologies']);
        }

        /* RETURN SULLA SHOW CON ID E CREO MESSAGGIO ALERT */
        return to_route('admin.projects.show', $project->id)->with('type', 'success')->with('message', "Elemento ( $project->title ) salvato");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        /* RETURN NELLA STESSA PAGINA */
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        /* CREO ARRAY CON GLI ID DI TECHNOLOGIES */
        $array_technologies = $project->technologies->pluck('id')->toArray();
        
        /* RECUPERO SOLO CIO CHE MI SERVE DAL MODELLO */
        $types = Type::select('label', 'id')->get();

        /* RECUPERO SOLO CIO CHE MI SERVE DAL MODELLO TECHNOLOGY */
        $technologies = Technology::select('label', 'id')->get();

        /* RETURN NELLA STESSA PAGINA */
        return view('admin.projects.edit', compact('project', 'types', 'array_technologies', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        /* RECUPERO VALIDAZIONE */
        $data = $request->validated();

        /* DATI VALIDATI */
        $project->fill($data);

        /* SLUG */
        $project->slug = Str::slug($project->title);

        /* VERIFICO SE ESISTE NELL'ARRAY ASSOCIATIVO DATA LA CHIAVE IS_PUBLISHED */
        $project->is_published = array_key_exists('is_published', $data);

        /* VERIFICO SE ESISTE NELL'ARRAY ASSOCIATIVO DATA ARRIVA UN FILE */
        if (Arr::exists($data, 'image')) {

            /* RECUPERO JPG, PNG ETC.. */
            $url = $data['image']->extension();

            /* CONTROLLORO SE CE GIA' UN IMMAGINE SE CE LA ELIMINO*/
            if ($project->image) {
                Storage::delete($project->image);
            }

            /* SALVO IL FILE IN UNA CARTELLA E PRENDO L'URL */
            $img_url = Storage::putFileAs('project_images', $data['image'], "$project->slug.$url");
            $project->image = $img_url;
        };

        /* SALVATAGGIO */
        $project->update($data);

        /* VERIFICO SE ESISTE NELL'ARRAY LA CHIAVE TECHNOLOGIIES, SE ESTISTE , ALTRIMENTI SE NON ESISTE E CI SONO RELAZIONI */
        if(Arr::exists($data, 'technologies')){
            /* SINCRONIZZO I RECORD DEL PROGETTO AI RECORD DELLE TECNOLOGIE */
            $project->technologies()->sync($data['technologies']);
            
        }elseif(!Arr::exists($data, 'technologies') && $project->has('technologies')){
            
            /* DISSOCIA I RECORD DEL PROGETTO AI RECORD DELLE TECNOLOGIE */
            $project->technologies()->detach($data['technologies']);
        }

        /* RETURN SULLA SHOW CON ID E CREO MESSAGGIO ALERT */
        return to_route('admin.projects.show', $project->id)->with('type', 'info')->with('message', "Elemento ( $project->title ) aggiornato");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        /* ELIMINI ELEEMNTO */
        $project->delete();

        /* RETURN SULLA INDEX E CREO TOAST DINAMICO */
        return to_route('admin.projects.index')
            ->with('toast-title', config('app.name'))
            ->with('toast-button-type', 'warning')
            ->with('toast-body', "$project->title messo nel cestino")
            ->with('toast-message', 'Elemento messo nel cestino')
            ->with('toast-method', 'PATCH')
            ->with('toast-ruote', route('admin.projects.restore', $project->id))
            ->with('toast-button-label', 'Annula');
    }


    /* ROTTE CESTINO */
    public function trash()
    {
        /* RECUPERO TUTTI I PROGETTI ELIMINATI */
        $projects = Project::onlyTrashed()->get();

        /* RETURN NELLA STESSA PAGINA */
        return view('admin.projects.trash', compact('projects'));
    }

    public function restore(string $id)
    {
        /* RECUPERO ELEMENTO CON ID SPECIFICO SE ELEMINATO */
        $projects = Project::onlyTrashed()->findOrFail($id);

        /* RIPRISTINO */
        $projects->restore();

        /* RETURN SULLA INDEX E CREO MESSAGGIO ALERT */
        return to_route('admin.projects.index')->with('type', 'success')->with('message', "Elemento ( $projects->title ) ripreso dal cestino");
    }

    public function drop(string $id, Project $project)
    {
        /* RECUPERO ELEMENTO CON ID SPECIFICO SE ELEMINATO */
        $projects = Project::onlyTrashed()->findOrFail($id);

        /* SE CI SONO RELAZIONI */
        if ($project->has('technologies')) {
            /* DISSOCIA I RECORD DEL PROGETTO AI RECORD DELLE TECNOLOGIE */
            $project->technologies()->detach();
        }

        /* SE CE UN PROGETTO  */
        if ($projects) {
            /* ELIMINAZIONE */
            Storage::delete($projects->image);
        }

        /* ELIMINO DEFINITIVAMENTE L'ELEMENTO */
        $projects->forceDelete();

        /* RETURN SULLA INDEX E CREO MESSAGGIO ALERT */
        return to_route('admin.projects.index')->with('type', 'danger')->with('message', "Elemento ( $projects->title ) eliminato");
    }

    public function empty()
    {
        /* RECUPERO TUTTI GLI ELEMENTI SE ELIMINATI */
        $projects = Project::onlyTrashed()->get();
        
        /* CICLO SU TUTTI I PROGETTI */
        foreach ($projects as $project) {
            
            /* SE HANNO UN TITOLO  */
            if ($project->title) {
                /* ELIMINAZIONE */
                Storage::delete($project->title);
            }
            
            /* ELIMINO DEFINITIVAMENTE L'ELEMENTI */
            $project->forceDelete();
        }
        
        /* RETURN SUL TRASH E CREO MESSAGGIO ALERT */
        return to_route('admin.projects.trash')->with('type', 'danger')->with('message', 'Tutti i progetti sono stati eliminitati definitivamente');
    }


    /* ROTTA SWITCH */
    public function togglePublication(Project $project)
    {
        /* TOGGLE */
        $project->is_published = !$project->is_published;

        /* OPZIONE */
        $action = $project->is_published ? 'Pubblicato' : 'messo in Bozza';

        /* COLORE ALERT */
        $type = $project->is_published ? 'success' : 'warning';

        /* SALVO */
        $project->save();

        /* RETURN SULLA INDEX E CREO MESSAGGIO ALERT */
        return to_route('admin.projects.index')->with('type', $type)->with('message', "Elemento ( $project->title ) è stato $action");
    }
}