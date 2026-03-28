@extends('layouts.app')
@section('title', 'Tareas')
@section('header', 'Tareas')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Entregar tarea</h1>
            <div class="bg-white p-4 rounded shadow mb-4">
                <h2 class="text-lg font-bold">{{ $entrega->task->title }}</h2>
                <p>Fecha límite: {{ $entrega->task->due_date }}</p>
                <p>{{ $entrega->task->description }}</p>

                <form action="{{ route('student.tarea.update', $entrega->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" name="file_path" accept="application/pdf" required class="border rounded px-3 py-2 mb-2 w-full">
                    <div class="flex gap-5 mt-4">
                        <a href="{{ route('student.tareas') }}" class="bg-red-500 text-white font-bold py-2 px-4 rounded">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Actualizar entrega
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection