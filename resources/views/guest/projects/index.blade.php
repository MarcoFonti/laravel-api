@extends('layouts.app')

@section('title', 'Projects List')

@section('content')
    <div class="container">
        <header class="mt-4">
            <h1 class="text-uppercase text-danger text-decoration-underline">BoolFolio</h1>
        </header>
        <div class="row d-flex justify-content-end">
            <div class="col-3">
                <form method="GET" action="{{ route('guest.projects.index') }}">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Cerca Progetto" name="search"
                            value="{{ $search }}" autofocus>
                        <button class="btn btn-outline-primary" type="submit">Cerca</button>
                    </div>
                </form>
            </div>
        </div>
        @forelse ($projects as $project)
            <div class="card my-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase me-3">{{ $project->title }}</span>
                        <span>
                            <strong class="text-uppercase"><i class="fa-solid fa-screwdriver-wrench">:</i></strong>
                            @forelse ($project->technologies as $technology)
                                <span class="badge rounded-pill text-bg-{{ $technology->color }}">{{ $technology->label }}</span>
                            @empty
                                <span>Nessuna</span>
                        @endforelse
                        </span>
                    </div>
                    <a href="{{ route('guest.projects.show', $project->slug) }}" class="btn btn-primary"><i
                            class="fas fa-eye"></i></a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if ($project->image)
                            <div class="col-3 mt-1">
                                <img src="{{ $project->assetUrl() }}" alt="{{ $project->title }}" class="img-fluid">
                            </div>
                        @endif
                        <div class="col">
                            <h5 class="card-title mb-2 text-uppercase">{{ $project->title }}</h5>
                            <h6 class="card-subtitle mb-3 text-body-secondary">{{ $project->getCreatedAt() }}</h6>
                            <div class="d-flex align-items-center gap-1 mb-2"><strong class="text-uppercase">Tipologia:</strong>
                                @if ($project->type)
                                    <span class="badge" style="background-color: {{ $project->type->color }}">{{ $project->type->label }}</span>
                                @else
                                    Nessuna
                                @endif
                            </div>
                            <p class="card-text">{{ $project->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h3 class="text-center">Non ci sono progetti</h3>
        @endforelse
    </div>
@endsection
