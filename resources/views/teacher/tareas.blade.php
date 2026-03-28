@extends('layouts.app')
@section('title', 'Tareas')
@section('header', 'Tareas')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Asignar tareas</h1>
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

            <form action="{{ route('teacher.tareas.save') }}" method="post" class="space-y-4">
                @csrf
                <input type="hidden" name="group_id" value="{{ $groupId }}">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Titulo</label>
                    <input type="text" name="title"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Descripción</label>
                    <input type="text" name="description"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Fecha de entrega</label>
                    <input type="date" name="due_date"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <button {{ !$groupId ? 'disabled' : '' }} 
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition disabled:bg-gray-400">
                    Asignar
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="p-4 text-left">Título</th>
                        <th class="p-4 text-left">Grupo</th>
                        <th class="p-4 text-left">Fecha entrega</th>
                        <th class="p-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-4">{{ $task->title }}</td>
                            <td class="p-4">{{ $task->group->name }}</td>
                            <td class="p-4">{{ $task->due_date }}</td>
                            <td class="p-4 flex gap-3">
                                <a href="{{ route('teacher.tarea.edit', $task->id) }}" class="text-blue-600 hover:underline">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>

                                <form action="{{ route('teacher.tarea.delete', $task->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600" onclick="return confirm('¿Eliminar?')">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>

                                <a href="{{ route('teacher.entregas', $task->id) }}" class="text-green-600 hover:underline">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">
                                No hay tareas registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection