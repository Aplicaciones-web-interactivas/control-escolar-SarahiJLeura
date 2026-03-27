@extends('layouts.app')
@section('title', 'Register')
@section('header', 'Register')
@section('content')
    <div>
        <div class="bg-white p-6 rounded-xl shadow border">
            <form action="{{ route('save.register') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre:</label>
                    <input type="text" name="name" id="name" 
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label for="user_key" class="block text-gray-700 font-bold mb-2">Clave institucional:</label>
                    <input type="text" name="user_key" id="user_key" 
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label for="pass" class="block text-gray-700 font-bold mb-2">Contraseña:</label>
                    <input type="password" name="pass" id="pass" 
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Registrarse
                </button>
            </form>
        </div>
    </div>
@endsection