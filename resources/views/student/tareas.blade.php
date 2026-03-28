@extends('layouts.app')
@section('title', 'Tareas')
@section('header', 'Tareas')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Tareas por grupo</h1>
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
        </div>

        <div class="bg-white rounded-xl shadow border overflow-hidden">

            <form method="GET" class="flex gap-4 mb-4">
                <input type="hidden" name="group_filter" value="{{ $groupId }}">

                <select name="status" onchange="this.form.submit()"
                    class="border rounded-lg px-3 py-2">
                    <option value="">Todas</option>
                    <option value="terminadas" {{ $status == 'terminadas' ? 'selected' : '' }}>Terminadas</option>
                    <option value="pendientes" {{ $status == 'pendientes' ? 'selected' : '' }}>Pendientes</option>
                    <option value="no_entregadas" {{ $status == 'no_entregadas' ? 'selected' : '' }}>No entregadas</option>
                </select>
            </form>

            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="p-4 text-left">Título</th>
                        <th class="p-4 text-left">Grupo</th>
                        <th class="p-4 text-left">Fecha entrega</th>
                        <th class="p-4 text-left">Estado</th>
                        <th class="p-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-4">{{ $task->title }}</td>
                            <td class="p-4">{{ $task->group->name }}</td>
                            <td class="p-4">{{ $task->due_date }}</td>
                            @php
                                $submitted = $task->submissions->where('student_id', auth()->id())->count();
                                $isLate = \Carbon\Carbon::parse($task->due_date)->isPast();
                            @endphp
                            <td class="p-4">
                                @if($submitted)
                                    <span class="text-green-600 font-bold">Terminada</span>
                                @elseif($isLate)
                                    <span class="text-red-600 font-bold">No entregada</span>
                                @else
                                    <span class="text-yellow-600 font-bold">Pendiente</span>
                                @endif
                            </td>
                            <td class="p-4 flex gap-3">
                                @if($submitted)
                                    <a href="{{ route('student.tarea.edit', $task->id) }}" class="text-blue-600 hover:underline">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                @elseif($isLate)
                                    <a href="" class="text-red-600 hover:underline">
                                        <span class="material-symbols-outlined">cancel</span>
                                    </a>
                                @else
                                    <a href="{{ route('student.tarea.view', $task->id) }}" class="text-green-600 hover:underline">
                                        <span class="material-symbols-outlined">add</span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">
                                No hay tareas disponibles
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection