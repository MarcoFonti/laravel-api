@extends('layouts.app')

@section('title', 'Edit Technology')

@section('content')
    <div class="card m-5 p-3 shadow-lg">
        <h1 class="text-center mt-3 text-uppercase text-danger">Modifica Tecnologia</h1>
        <form action="{{ route('admin.technologies.update', $technology->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-9">
                    <div class="mb-3">
                        <label for="label" class="form-label">Etichetta Tecnologia</label>
                        <input type="text"
                            class="form-control 
                            @error('label') is-invalid 
                            @elseif(old('label')) is-valid 
                            @enderror"
                            id="label" placeholder="Etichetta" name="label"
                            value="{{ old('label', $technology->label) }}">
                        @error('label')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="color" class="form-label">Colore Tecnologia</label>
                        <input type="color"
                            class="form-control 
                            @error('color') is-invalid 
                            @elseif(old('color')) is-valid 
                            @enderror"
                            id="color" placeholder="Colore" name="color"
                            value="{{ old('color', $technology->color) }}">
                        @error('color')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-start align-items-center">
                        <a class="btn btn-secondary" href="{{ route('admin.technologies.index') }}"><i
                                class="fa-solid fa-rotate-left me-2"></i>Torna Indietro</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-end align-items-center gap-3">
                        <button type="reset" class="btn btn-info"><i class="fas fa-eraser me-2"></i>Svuota campi</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-floppy-disk me-2"></i>Salva
                            Progetto</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

