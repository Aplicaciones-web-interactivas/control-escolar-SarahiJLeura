@extends('layouts.app')
@section('title', 'Inscripciones')
@section('header', 'Inscripciones')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Editar Inscipción</h1>
            <form action="{{ route('update.inscripcion', $enrollEdit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Grupo:</label>
                    <select name="group_id" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @foreach($groups as $gr)
                            <option value="{{ $gr->id }}"
                                {{ $gr->id == $enrollEdit->group_id ? 'selected' : '' }}>
                                
                                {{ $gr->name }} | 
                                {{ $gr->schedule->course->name }} | 
                                {{ $gr->schedule->teacher->name }} | 
                                {{ $gr->schedule->start_time }} - {{ $gr->schedule->end_time }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Alumno:</label>
                    <select name="user_id" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ $user->id == $enrollEdit->user_id ? 'selected' : '' }}>
                                
                                {{ $user->institutional_key }} | {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex align-items gap-5">
                    <a href="/inscripciones" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-4">
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