@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Mis Tareas</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            + Nueva Tarea
        </a>
    </div>

    @if($tasks->isEmpty())
        <div class="alert alert-info">
            No tienes tareas aún. ¡Crea una!
        </div>
    @else
        <div class="card">
            <ul class="list-group list-group-flush">
                @foreach($tasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        
                        <div>
                            {{-- Si está completada, tachamos el título --}}
                            @if($task->completed)
                                <s class="text-muted">{{ $task->title }}</s>
                                <span class="badge bg-success ms-2">Completada</span>
                            @else
                                <strong>{{ $task->title }}</strong>
                                <span class="badge bg-warning ms-2">Pendiente</span>
                            @endif

                            {{-- Mostrar descripción si existe --}}
                            @if($task->description)
                                <p class="text-muted small mb-0">{{ $task->description }}</p>
                            @endif
                        </div>

                        {{-- Botones de acción --}}
                        <div class="d-flex gap-2">
                            <a href="{{ route('tasks.edit', $task) }}" 
                               class="btn btn-sm btn-outline-primary">
                                Editar
                            </a>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('¿Eliminar esta tarea?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
