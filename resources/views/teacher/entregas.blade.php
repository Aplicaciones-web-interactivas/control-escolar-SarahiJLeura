@extends('layouts.app')
@section('title', 'Tareas')
@section('header', 'Tareas')
@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="bg-white p-6 rounded-xl shadow border">
        <h1 class="text-xl font-bold mb-4">Entregas de la tarea: {{ $task->title }}</h1>
        <p class="mb-4">{{ $task->description }}</p>
        <p class="mb-4">Fecha límite: {{ $task->due_date }}</p>

        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="p-4 text-left">Alumno</th>
                        <th class="p-4 text-left">Archivo</th>
                        <th class="p-4 text-left">Fecha de entrega</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($task->submissions as $sub)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-4">{{ $sub->student->name }}</td>
                            <td class="p-4">
                                <a href="{{ asset('storage/'.$sub->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                    Ver PDF
                                </a>
                            </td>
                            <td class="p-4">{{ $sub->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-4 text-center text-gray-500">
                                No hay entregas aún
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('teacher.tareas') }}" class="bg-red-500 text-white font-bold py-2 px-4 rounded">
                Regresar
            </a>
        </div>
    </div>
</div>
@endsection