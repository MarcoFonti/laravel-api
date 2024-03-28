@extends('layouts.app')

@section('title', 'Projects List Admin')

@section('content')
    <div class="container">
        <header class="d-flex justify-content-between align-items-center">
            <h1 class="mt-4 text-uppercase text-danger">Lista Progetti</h1>
            <div class="d-flex justify-content-center align-items-center gap-3 mt-4">
                {{-- FITRLI --}}
                <form action="{{ route('admin.projects.index') }}" method="GET">
                    {{-- FITRLO PUBBLICAZIONE --}}
                    <div class="input-group mb-3">
                        <select name="filter" class="form-select">
                            <option value="">Tutti i progetti</option>
                            <option @if ($filter === 'published') selected @endif value="published">Completati</option>
                            <option @if ($filter === 'draft') selected @endif value="draft">Bozze</option>
                        </select>
                        <button class="btn btn-dark text-warning" type="submit">Filtra</button>
                    </div>
                    {{-- FILTRO PER TIPOLOGIA --}}
                    <div class="input-group mb-3">
                        <select name="type_filter" class="form-select">
                            <option value="">Tutte le tipologie</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @if ($type_filter == $type->id) selected @endif>
                                    {{ $type->label }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-dark text-warning" type="submit">Filtra</button>
                    </div>
                    {{-- FILTRO PER TECNOLOGIE --}}
                    <div class="input-group">
                        <select name="technology_filter" class="form-select">
                            <option value="">Tutte le tecnologie</option>
                            @foreach ($technologies as $technology)
                                <option value="{{ $technology->id }}" @if ($technology_filter == $technology->id) selected @endif>
                                    {{ $technology->label }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-dark text-warning" type="submit">Filtra</button>
                    </div>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-dark text-danger mt-3 w-100" type="submit">Reset Filtro</a>
                </form>
            </div>
        </header>
        <div class="card p-3 shadow-lg mt-3">
            <a href="{{ route('admin.projects.trash') }}" class="btn btn-secondary m-auto">Vedi Cestino<i
                    class="far fa-trash-can ms-2"></i></a>
            <table class="table table-dark table-striped table-hover mt-4">
                <thead>
                    <tr class="text-uppercase">
                        <th class="text-warning" scope="col">#</th>
                        <th class="text-warning" scope="col">Titolo</th>
                        <th class="text-warning" scope="col">Slug</th>
                        <th class="text-warning" scope="col">Tipologia</th>
                        <th class="text-warning" scope="col">Technology</th>
                        <th class="text-warning" scope="col">Pubblicato</th>
                        <th class="text-warning" scope="col">Data creazione</th>
                        <th class="text-warning" scope="col">Ultima modifica</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->slug }}</td>
                            <td>
                                <span
                                    @if ($project->type) class="badge" style="background-color: {{ $project->type->color }}" @endif>{{ $project->type ? $project->type->label : '-' }}</span>
                            </td>
                            <td>
                                @forelse ($project->technologies as $technology)
                                    <span class="badge rounded-pill text-bg-{{ $technology->color }}">{{ $technology->label }}</span>
                                @empty
                                    -
                                @endforelse
                            </td>
                            <td>
                                <form action="{{ route('admin.projects.switch', $project->id) }}" method="POST"
                                    onclick="this.submit()">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="button"
                                            id="{{ 'is_published' . $project->id }}"
                                            @if ($project->is_published) checked @endif>
                                        <label class="form-check-label"
                                            for="{{ 'is_published' . $project->id }}">{{ $project->is_published ? 'SI' : 'NO' }}</label>
                                    </div>
                                </form>
                            </td>
                            <td>{{ $project->getCreatedAt() }}</td>
                            <td>{{ $project->getUpdatedAt() }}</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.show', $project->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="post"
                                        class="trash-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="far fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <h3>Non ci sono progetti al momento</h3>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($projects->hasPages())
                {{ $projects->links() }}
            @endif
        </div>
        <div class="card w-50 m-auto mt-4 mb-4 p-4 shadow-lg">
            <h4 class="text-center text-uppercase text-danger">Progetti per tipologia</h4>
            <ol class="list-group list-group- list-group-item-dark">
                @foreach ($types as $type)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-bold">{{ $type->label }}</div>
                            @forelse ($type->projects as $project)
                                <small class="ms-3">- <a
                                        href="{{ route('admin.projects.show', $project->id) }}">{{ $project->title }}
                                        <br></a></small>
                            @empty
                                <small class="ms-3">- Nessun Progetto <br></small>
                            @endforelse
                        </div>
                        <span class="badge text-bg-primary rounded-pill">{{ count($type->projects) }}</span>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection

@section('js')
    {{-- TOAST --}}
    @vite('resources/js/toast.js')
@endsection
