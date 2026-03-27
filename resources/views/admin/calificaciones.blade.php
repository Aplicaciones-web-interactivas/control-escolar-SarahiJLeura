@extends('layouts.app')
@section('title', 'Calificaciones')
@section('header', 'Calificaciones')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Subir Calificaciones</h1>

            <form method="GET" action="">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Selecciona grupo:</label>
                    <select name="group_filter" onchange="this.form.submit()" 
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">-- Selecciona grupo --</option>
                        @foreach($groups as $gr)
                            <option value="{{ $gr->id }}" {{ $groupId == $gr->id ? 'selected' : '' }}>
                                {{ $gr->name }} | {{ $gr->schedule->course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            @if($enrollments->count())
            <div class="bg-white rounded-xl shadow border overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="p-4 text-left">Clave Alumno</th>
                            <th class="p-4 text-left">Nombre Alumno</th>
                            <th class="p-4 text-left">Grupo</th>
                            <th class="p-4 text-left">Materia</th>
                            <th class="p-4 text-left">Calificación</th>
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
                            <td class="p-4">
                                @if($enroll->grade)
                                    {{ $enroll->grade->grade }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class=p-4">
                                @if($enroll->grade)
                                    <a href="{{ route('edit.calificacion', $enroll->grade->id) }}" class="text-blue-500 hover:text-blue-700">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <form action="{{ route('delete.calificacion', $enroll->grade->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Eliminar calificación?')">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('save.calificacion') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="enrollment_id" value="{{ $enroll->id }}">
                                        <input type="number" name="grade" min="0" max="10" step="0.1" class="border rounded w-20" required>
                                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Guardar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p>Selecciona un grupo para ver los alumnos inscritos.</p>
            @endif
        </div>
    </div>
@endsection