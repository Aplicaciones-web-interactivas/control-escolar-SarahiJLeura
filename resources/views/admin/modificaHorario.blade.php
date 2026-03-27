@extends('layouts.app')
@section('title', 'Horarios')
@section('header', 'Horarios')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Editar Horario</h1>
            <form action="{{ route('update.horario', $horario->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="course" class="block text-gray-700 font-bold mb-2">Materia:</label>
                    <select name="courseId" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @foreach($courses as $course)

                        <option value="{{ $course->id }}" {{ $horario->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="teacher" class="block text-gray-700 font-bold mb-2">Profesor:</label>
                    <select name="teacherId" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @foreach($teachers as $teacher)

                        <option value="{{ $teacher->id }}" {{ $horario->teacher_id == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="startTime" class="block text-gray-700 font-bold mb-2">Hora inicio:</label>
                    <input type="time" name="startTime" value="{{ $horario->start_time }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label for="endTime" class="block text-gray-700 font-bold mb-2">Hora fin:</label>
                    <input type="time" name="endTime" class="border rounded w-full" value="{{ $horario->end_time }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                @php
                    $selectedDays = explode(',', $horario->days);
                @endphp

                <div class="mb-4">
                    <label for="days" class="block text-gray-700 font-bold mb-2">Días:</label>
                    <label>
                        <input type="checkbox" name="days[]" value="Mon" {{ in_array('Mon', $selectedDays) ? 'checked' : '' }}> Lunes
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Tue" {{ in_array('Tue', $selectedDays) ? 'checked' : '' }}> Martes
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Wed" {{ in_array('Wed', $selectedDays) ? 'checked' : '' }}> Miércoles
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Thur" {{ in_array('Thur', $selectedDays) ? 'checked' : '' }}> Jueves
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Fri" {{ in_array('Fri', $selectedDays) ? 'checked' : '' }}> Viernes
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Sat" {{ in_array('Sat', $selectedDays) ? 'checked' : '' }}> Sábado
                    </label>
                </div>
                <div class="flex align-items gap-5">
                    <a href="/horarios" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-4">
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