@extends('layouts.app')
@section('title', 'Tareas')
@section('header', 'Tareas')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Editar tarea</h1>

            <form action="{{ route('teacher.tarea.update', $tarea->id) }}" method="post" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Titulo</label>
                    <input type="text" name="title" value="{{ $tarea->title }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Descripción</label>
                    <input type="text" name="description" value="{{ $tarea->description }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Fecha de entrega</label>
                    <input type="date" name="due_date" value="{{ $tarea->due_date }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <div class="flex align-items gap-5">
                    <a href="{{ route('teacher.tareas') }}" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-4">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection