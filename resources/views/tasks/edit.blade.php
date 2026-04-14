@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h1 class="h4 fw-bold mb-0">Editar Tarea</h1>
                    <p class="text-muted small mb-0">Modifica los campos que necesites</p>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-type me-1"></i>Título *
                            </label>
                            <input 
                                type="text" 
                                name="title" 
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $task->title) }}"
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-card-text me-1"></i>Descripción
                                <span class="text-muted fw-normal">(opcional)</span>
                            </label>
                            <textarea 
                                name="description" 
                                class="form-control @error('description') is-invalid @enderror"
                                rows="4"
                            >{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Checkbox completada --}}
                        <div class="mb-4 p-3 rounded-3" style="background: #f8f9fa;">
                            <div class="form-check">
                                <input 
                                    type="checkbox" 
                                    name="completed" 
                                    class="form-check-input"
                                    id="completed"
                                    {{ $task->completed ? 'checked' : '' }}
                                    style="width: 1.2em; height: 1.2em; cursor: pointer;"
                                >
                                <label class="form-check-label ms-2 fw-medium" for="completed">
                                    <i class="bi bi-check-circle me-1 text-success"></i>
                                    Marcar como completada
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i>Actualizar Tarea
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection