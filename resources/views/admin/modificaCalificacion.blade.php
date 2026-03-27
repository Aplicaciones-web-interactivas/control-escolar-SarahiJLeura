@extends('layouts.app')
@section('title', 'Calificaciones')
@section('header', 'Calificaciones')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Modificar calificación</h1>
            <form action="{{ route('update.calificacion', $gradeEdit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Grupo:</label>
                    <input type="text" 
                        value="{{ $gradeEdit->enrollment->group->name }} | 
                            {{ $gradeEdit->enrollment->group->schedule->course->name }} | 
                            {{ $gradeEdit->enrollment->group->schedule->teacher->name }} | 
                            {{ $gradeEdit->enrollment->group->schedule->start_time }} - 
                            {{ $gradeEdit->enrollment->group->schedule->end_time }}"
                        class="w-full border rounded-lg px-3 py-2 bg-gray-100 cursor-not-allowed" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Alumno:</label>
                    <input type="text"
                        value="{{ $gradeEdit->enrollment->user->institutional_key }} | 
                            {{ $gradeEdit->enrollment->user->name }}"
                        class="w-full border rounded-lg px-3 py-2 bg-gray-100 cursor-not-allowed" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Calificación:</label>
                    <input type="number" name="grade" min="0" max="10" step="0.1"
                        value="{{ $gradeEdit->grade }}" class="border rounded w-32">
                </div>

                <div class="flex align-items gap-5">
                    <a href="{{ route('index.calificaciones') }}" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-4">
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