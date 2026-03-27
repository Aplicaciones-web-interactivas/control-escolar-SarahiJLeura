@extends('layouts.app')
@section('title', 'Grupos')
@section('header', 'Grupos')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Agregar grupos</h1>
            <form action="{{ route('save.grupo') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre del grupo:</label>
                    <input type="text" name="name" id="name" 
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label for="schedule" class="block text-gray-700 font-bold mb-2">Horario:</label>
                    <select name="scheduleId" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @foreach($schedules as $hr)
                            <option value="{{ $hr->id }}">
                                {{ $hr->course->name }} | {{ $hr->teacher->name }} | {{ $hr->start_time }} - {{ $hr->end_time }} | {{ $hr->days }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Agregar Grupo
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="p-4 text-left">Nombre del Grupo</th>
                        <th class="p-4 text-left">Materia</th>
                        <th class="p-4 text-left">Profesor</th>
                        <th class="p-4 text-left">Hora inicio</th>
                        <th class="p-4 text-left">Hora fin</th>
                        <th class="p-4 text-left">Días</th>
                        <th class="p-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($groups as $gr)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4">{{ $gr->name }}</td>
                        <td class="p-4">{{ $gr->schedule->course->name }}</td>
                        <td class="p-4">{{ $gr->schedule->teacher->name }}</td>
                        <td class="p-4">{{ $gr->schedule->start_time }}</td>
                        <td class="p-4">{{ $gr->schedule->end_time }}</td>
                        <td class="p-4">{{ $gr->schedule->days }}</td>
                        <td class="p-4">
                            <a href="{{ route('edit.grupo', $gr->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            <form action="{{ route('delete.grupo', $gr->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar grupo?')" class="text-red-500 hover:text-red-700">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection