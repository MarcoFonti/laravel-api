@extends('layouts.app')

@section('title', 'Project Admin')

@section('content')
    <div class="container">
        <header>
            <h1 class="text-center my-3 text-uppercase text-danger">{{ $project->title }}</h1>
        </header>
        <div class="card p-3">
            <div class="clearfix">
                @if ($project->image)
                    <img src="{{ $project->assetUrl() }}" alt="{{ $project->title }}" class="me-3 float-start mt-1 img-fluid">
                @endif
                <p>{{ $project->content }}</p>
                <div class="d-flex align-items-center gap-1 mb-2"><strong class="text-uppercase">Tipologia:</strong>
                    @if ($project->type)
                        <span class="badge" style="background-color: {{ $project->type->color }}">{{ $project->type->label }}</span>
                    @else
                        Nessuna
                    @endif
                </div>
                <div>
                    <strong class="text-uppercase">Data creazione: </strong> <span class="me-3">{{ $project->getCreatedAt() }}</span>
                    <strong class="text-uppercase">Ultima modifica: </strong> <span>{{ $project->getUpdatedAt() }}</span>
                    <div class="mt-2 d-flex align-items-center gap-1">
                        <strong class="text-uppercase">Tecnologie: </strong>
                        @forelse ($project->technologies as $technology)
                            <span class="badge rounded-pill text-bg-{{ $technology->color }}">{{ $technology->label }}</span>
                        @empty
                            <span>Nessuna</span>
                        @endforelse
                    </div>
                </div>
            </div>
            <footer class="d-flex justify-content-between align--items-center mt-5">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-rotate-left me-2"></i>
                    Torna indietro
                </a>
                <div class="d-flex justify-content-between gap-3">
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning">
                        <i class="fas fa-pencil me-2"></i>
                        Modifica
                    </a>
                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="post" class="trash-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="far fa-trash-can me-2"></i>
                            Metti nel cestino</button>
                    </form>
                </div>
            </footer>
        </div>
    </div>
@endsection

@section('js')
    {{-- TOAST --}}
    @vite('resources/js/toast.js')
@endsection
