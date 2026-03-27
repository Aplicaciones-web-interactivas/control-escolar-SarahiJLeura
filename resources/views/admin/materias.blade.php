@extends('layouts.app')
@section('title', 'Materias')
@section('header', 'Materias')
@section('content')

<div class="max-w-6xl mx-auto space-y-6">
    <div class="bg-white p-6 rounded-xl shadow border">
        <h1 class="text-xl font-bold mb-4">Agregar materias</h1>
        <form action="{{ route('save.materia') }}" method="post" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-bold mb-2">Nombre</label>
                <input type="text" name="name"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Código</label>
                <input type="text" name="code"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Agregar
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="p-4 text-left">Nombre</th>
                    <th class="p-4 text-left">Código</th>
                    <th class="p-4 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($materias as $mat)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4">{{ $mat->name }}</td>
                        <td class="p-4">{{ $mat->code }}</td>
                        <td class="p-4 flex gap-3">
                            <a href="{{ route('edit.materia', $mat->id) }}" class="text-blue-600 hover:underline">
                                <span class="material-symbols-outlined">edit</span>
                            </a>

                            <form action="{{ route('delete.materia', $mat->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600" onclick="return confirm('¿Eliminar?')">
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