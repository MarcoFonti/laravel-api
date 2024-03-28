@extends('layouts.app')

@section('title', 'Projects List trashed')

@section('content')
    <div class="container">
        <header>
            <h1 class="text-center mt-4 text-uppercase text-danger">Lista Progetti Eliminati</h1>
        </header>
        <div class="card shadow-lg mt-3 p-3">
            <table class="table table-dark table-striped table-hover mt-3 rounded">
                <thead>
                    <tr class="text-uppercase">
                        <th class="text-warning" scope="col">#</th>
                        <th class="text-warning" scope="col">Titolo</th>
                        <th class="text-warning" scope="col">Slug</th>
                        <th class="text-warning" scope="col">Tipologia</th>
                        <th class="text-warning" scope="col">Stato</th>
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
                                <span @if ($project->type) class="badge" style="background-color: {{ $project->type->color }}" @endif >{{ $project->type ? $project->type->label : '-' }}</span>
                            </td>
                            <td>{{ $project->is_published ? 'Pubblicato' : 'Bozza' }}</td>
                            <td>{{ $project->getCreatedAt() }}</td>
                            <td>{{ $project->getUpdatedAt() }}</td>
                            <td>
                                <div class="d-flex justify-content-end gap-2 ">
                                    <a href="{{ route('admin.projects.show', $project->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.projects.restore', $project->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-arrows-rotate"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.projects.drop', $project->id) }}" method="post"
                                        class="delete-form" data-bs-toggle="modal" data-bs-target="#modal">
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
                            <td colspan="8">
                                <h3>Non ci sono progetti nel cestino</h3>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                <a class="btn btn-secondary" href="{{ route('admin.projects.index') }}">
                    <i class="fa-solid fa-rotate-left me-2"></i>Torna Indietro</a>
                <form action="{{ route('admin.projects.empty') }}" method="POST" data-title="" data-bs-toggle="modal"
                    data-bs-target="#modal" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-info">
                        <i class="fa-solid fa-trash-can-arrow-up me-2"></i>Svuota Cestino
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- MODALE --}}
    @vite('resources/js/modal.js')
@endsection
