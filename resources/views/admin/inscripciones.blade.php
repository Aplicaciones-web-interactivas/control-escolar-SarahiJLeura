@extends('layouts.app')
@section('title', 'Inscripciones')
@section('header', 'Inscripciones')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Inscribir alumno a grupo</h1>
            <form method="GET" action="">
                <div class="mb-4">
                    <label for="schedule" class="block text-gray-700 font-bold mb-2">Selecciona grupo:</label>
                    <select name="group_form"  onchange="this.form.submit()" 
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        <option value="">-- Selecciona grupo --</option>
                        @foreach($groups as $gr)
                            <option value="{{ $gr->id }}" 
                                {{ $groupForm == $gr->id ? 'selected' : '' }}>
                                {{ $gr->name }} | {{ $gr->schedule->course->name }} |
                                {{ $gr->schedule->teacher->name }} | 
                                {{ $gr->schedule->start_time }} - {{ $gr->schedule->end_time }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
            <form action="{{ route('save.inscripcion') }}" method="post">
                @csrf
                <input type="hidden" name="group_id" value="{{ $groupForm }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Alumnos disponibles:</label>
                    <select name="user_id" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        @forelse($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->institutional_key }} | {{ $user->name }}
                            </option>
                        @empty
                            <option disabled>No hay alumnos disponibles</option>
                        @endforelse
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Inscribir alumno
                </button>
            </form>
        </div>

        <div>
            <form method="GET" action="">
                <label class="block text-gray-700 font-bold mb-2">Para listar los alumnos selecciona un grupo:</label>
                <select name="group_table" onchange="this.form.submit()" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none mb-5">
                    <option value="">-- Selecciona grupo --</option>
                    @foreach($groups as $gr)
                        <option value="{{ $gr->id }}" 
                            {{ $groupTable == $gr->id ? 'selected' : '' }}>
                            {{ $gr->name }} | {{ $gr->schedule->course->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <div class="bg-white rounded-xl shadow border overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="p-4 text-left">Clave del alumno</th>
                            <th class="p-4 text-left">Nombre del alumno</th>
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
                        @foreach($enrollments as $enroll)
                        <tr>
                            <td class="p-4">{{ $enroll->user->institutional_key }}</td>
                            <td class="p-4">{{ $enroll->user->name }}</td>
                            <td class="p-4">{{ $enroll->group->name }}</td>
                            <td class="p-4">{{ $enroll->group->schedule->course->name }}</td>
                            <td class="p-4">{{ $enroll->group->schedule->teacher->name }}</td>
                            <td class="p-4">{{ $enroll->group->schedule->start_time }}</td>
                            <td class="p-4">{{ $enroll->group->schedule->end_time }}</td>
                            <td class="p-4">{{ $enroll->group->schedule->days }}</td>
                            <td class="p-4">
                                <a href="{{ route('edit.inscripcion', $enroll->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                <form action="{{ route('delete.inscripcion', $enroll->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar inscripcion?')" class="text-red-500 hover:text-red-700">
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
    </div>
@endsection