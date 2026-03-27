@extends('layouts.app')
@section('title', 'Horarios')
@section('header', 'Horarios')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Agregar Horarios</h1>
            <form action="{{ route('save.horario') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="course" class="block text-gray-700 font-bold mb-2">Materia:</label>
                    <select name="courseId" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @foreach($courses as $course)

                        <option value="{{ $course->id }}">
                            {{ $course->name }}
                        </option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="teacher" class="block text-gray-700 font-bold mb-2">Profesor:</label>
                    <select name="teacherId" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @foreach($teachers as $teacher)

                        <option value="{{ $teacher->id }}">
                            {{ $teacher->name }}
                        </option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="startTime" class="block text-gray-700 font-bold mb-2">Hora inicio:</label>
                    <input type="time" name="startTime" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label for="endTime" class="block text-gray-700 font-bold mb-2">Hora fin:</label>
                    <input type="time" name="endTime" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label for="days" class="block text-gray-700 font-bold mb-2">Días:</label>
                    <label>
                        <input type="checkbox" name="days[]" value="Mon"> Lunes
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Tue"> Martes
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Wed"> Miércoles
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Thur"> Jueves
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Fri"> Viernes
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Sat"> Sábado
                    </label>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Agregar Horario
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="p-4 text-left">Materia</th>
                        <th class="p-4 text-left">Profesor</th>
                        <th class="p-4 text-left">Hora inicio</th>
                        <th class="p-4 text-left">Hora fin</th>
                        <th class="p-4 text-left">Días</th>
                        <th class="p-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($horarios as $hr)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4">{{ $hr->course->name }}</td>
                            <td class="p-4">{{ $hr->teacher->name }}</td>
                            <td class="p-4">{{ $hr->start_time }}</td>
                            <td class="p-4">{{ $hr->end_time }}</td>
                            <td class="p-4">{{ $hr->days }}</td>
                            <td class="p-4">
                                <a href="{{ route('edit.horario', $hr->id) }}" class="text-blue-500 hover:text-blue-700">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                <form action="{{ route('delete.horario', $hr->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600" onclick="return confirm('¿Eliminar horario?')">
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