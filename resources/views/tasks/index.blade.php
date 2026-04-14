@extends('layout')

@section('content')

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">Mis Tareas</h1>
            <p class="text-muted small mb-0">
                {{ $tasks->count() }} tarea(s) en total —
                {{ $tasks->where('completed', false)->count() }} pendiente(s)
            </p>
        </div>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nueva Tarea
        </a>
    </div>

    {{-- Lista vacía --}}
    @if($tasks->isEmpty())
        <div class="card text-center py-5">
            <div class="card-body">
                <i class="bi bi-clipboard-x" style="font-size: 3rem; color: #ccc;"></i>
                <h5 class="mt-3 text-muted">No tienes tareas aún</h5>
                <p class="text-muted small">Crea tu primera tarea para empezar</p>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-lg me-1"></i> Crear tarea
                </a>
            </div>
        </div>

    @else
        <div class="card">
            <ul class="list-group list-group-flush">
                @foreach($tasks as $task)
                    <li class="list-group-item px-4 py-3" 
                        style="border-left: 4px solid {{ $task->completed ? '#4caf50' : '#667eea' }}">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                {{-- Título --}}
                                @if($task->completed)
                                    <span class="text-muted text-decoration-line-through fw-medium">
                                        {{ $task->title }}
                                    </span>
                                @else
                                    <span class="fw-semibold">{{ $task->title }}</span>
                                @endif

                                {{-- Badge estado --}}
                                @if($task->completed)
                                    <span class="badge bg-success ms-2">
                                        <i class="bi bi-check-lg me-1"></i>Completada
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark ms-2">
                                        <i class="bi bi-clock me-1"></i>Pendiente
                                    </span>
                                @endif

                                {{-- Descripción --}}
                                @if($task->description)
                                    <p class="text-muted small mb-0 mt-1">
                                        <i class="bi bi-text-left me-1"></i>{{ $task->description }}
                                    </p>
                                @endif

                                {{-- Fecha --}}
                                <p class="text-muted mb-0 mt-1" style="font-size: 0.78rem;">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $task->created_at->format('d M Y, h:i a') }}
                                </p>
                            </div>

                            {{-- Botones --}}
                            <div class="d-flex gap-2">
                                <a href="{{ route('tasks.edit', $task) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil me-1"></i>Editar
                                </a>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar esta tarea?')">
                                        <i class="bi bi-trash me-1"></i>Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection