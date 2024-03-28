@extends('layouts.app')

@section('title', 'Edit Projects')

@section('content')
    <div class="card m-5 p-3 shadow-lg">
        <h1 class="text-center mt-3 text-uppercase text-danger">Modifica progetto</h1>
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-5">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo Progetto</label>
                        <input type="text"
                            class="form-control 
                            @error('title') is-invalid 
                            @elseif(old('title')) is-valid 
                            @enderror"
                            id="title" placeholder="Titolo Progetto" name="title"
                            value="{{ old('title', $project->title) }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-5">
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug"
                            value="{{ Str::slug(old('title', $project->title)) }}" disabled>
                    </div>
                </div>
                <div class="col-2 mt-5">
                    <div class="mb-3 form-check form-switch">
                        <input value="1" type="checkbox" class="form-check-input" id="is_published" name="is_published"
                            @if (old('is_published', $project->is_published)) checked @endif>
                        <label for="is_published" class="form-check-label">Pubblica</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="content" class="form-label">Descrizione Progetto</label>
                        <textarea
                            class="form-control @error('content') is-invalid 
                        @elseif(old('content')) is-valid 
                        @enderror"
                            name="content" id="content" rows="10">{{ old('content', $project->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="type_id" class="form-label">Selezione Tipologia</label>
                        <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid 
                        @elseif(old('type_id', '')) is-valid 
                        @enderror">
                            <option value="">Nessuna</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @if (old('type_id', $project->type?->id) == $type->id)
                                    selected
                                @endif>{{ $type->label }}</option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-8">
                    <div class="mb-3">
                        <label for="image" class="form-label">Immagine Progetto</label>
                        <div id="container-change-image"
                            class="input-group @if (!$project->image) d-none @endif">
                            <button class="btn btn-secondary" type="button" id="button-change">Cambia File</button>
                            <input type="text" class="form-control" value="{{ old('image', $project->image) }}" disabled>
                        </div>
                        <input type="file"
                            class="form-control @if ($project->image) d-none @endif
                            @error('image') is-invalid 
                            @elseif(old('image')) is-valid 
                            @enderror"
                            id="image" placeholder="Http.// O https://" name="image">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-1">
                    <div class="mb-5">
                        <img src="{{ old('image', $project->image)
                            ? $project->assetUrl()
                            : 'https://marcolanci.it/boolean/assets/placeholder.png' }}"
                            class="img-fluid" alt="{{ $project->title }}" id="preview">
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <div class="mb-1">Seleziona le Tecnologie</div>
                        <div class="form-group @error('technologies') is-invalid 
                        @enderror">
                        @foreach ($technologies as $technology)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="{{ "techno-$technology->id" }}"
                                    value="{{ $technology->id }}" name="technologies[]" @if (in_array($technology->id , old('technologies', $array_technologies))) checked @endif>
                                <label class="form-check-label"
                                    for="{{ "techno-$technology->id" }}">{{ $technology->label }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('technologies')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-start align-items-center">
                        <a class="btn btn-secondary" href="{{ route('admin.projects.index') }}"><i
                                class="fa-solid fa-rotate-left me-2"></i>Torna Indietro</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-end align-items-center gap-3">
                        <button type="submit" class="btn btn-info"><i class="fas fa-eraser me-2"></i>Svuota campi</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-floppy-disk me-2"></i>Salva
                            Progetto</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    {{-- PREVIEW IMMAGINE --}}
    @vite('resources/js/preview_img.js')
    {{-- CAMBIO IMMAGINE --}}
    @vite('resources/js/image_change.js')
    {{-- SLUG TITOLO --}}
    @vite('resources/js/slug.js')
@endsection
