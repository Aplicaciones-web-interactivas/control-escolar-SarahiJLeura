@extends('layouts.app')
@section('title', 'Grupos')
@section('header', 'Grupos')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Editar grupo</h1>
            <form action="{{ route('update.grupo', $grupo->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre del grupo:</label>
                    <input type="text" name="name" id="name"value="{{ $grupo->name }}"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label for="schedule" class="block text-gray-700 font-bold mb-2">Horario:</label>
                    <select name="scheduleId" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @foreach($schedules as $hr)
                            <option value="{{ $hr->id }}" {{ $grupo->schedule_id == $hr->id ? 'selected' : '' }} >
                                {{ $hr->course->name }} | {{ $hr->teacher->name }} | {{ $hr->start_time }} - {{ $hr->end_time }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex align-items gap-5">
                    <a href="/grupos" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-4">
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