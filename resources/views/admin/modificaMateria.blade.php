@extends('layouts.app')
@section('title', 'Materias')
@section('header', 'Materias')
@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h1 class="text-xl font-bold mb-4">Editar materia</h1>
            <form action="{{ route('update.materia', $materia->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre de la materia:</label>
                    <input type="text" name="name" id="name" value="{{ $materia->name }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label for="code" class="block text-gray-700 font-bold mb-2">Código de la materia:</label>
                    <input type="text" name="code" id="code" value="{{ $materia->code }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div class="flex align-items gap-5">
                    <a href="/materias" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-4">
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