@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Nueva Tarea</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        {{-- Campo Título --}}
                        <div class="mb-3">
                            <label class="form-label">Título *</label>
                            <input 
                                type="text" 
                                name="title" 
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                placeholder="Ej: Comprar leche"
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Descripción --}}
                        <div class="mb-3">
                            <label class="form-label">Descripción (opcional)</label>
                            <textarea 
                                name="description" 
                                class="form-control @error('description') is-invalid @enderror"
                                rows="3"
                                placeholder="Detalles de la tarea..."
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Guardar Tarea
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection