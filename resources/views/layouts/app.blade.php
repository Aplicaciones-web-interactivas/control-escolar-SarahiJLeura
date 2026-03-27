<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EduManage')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>

<body class="font-[Inter] bg-slate-100 text-slate-900">
<div class="flex min-h-screen">

    {{-- SIDEBAR FOR COMPUTERS WIDTH--}}
    <aside class="hidden lg:flex flex-col w-64 bg-white border-r border-slate-200">

        <!-- Logo -->
        <div class="p-6 flex items-center gap-3">
            <div class="bg-blue-600 text-white p-2 rounded-lg">
                <span class="material-symbols-outlined">school</span>
            </div>
            <h1 class="text-xl font-bold text-blue-600">EduManage</h1>
        </div>

        @auth
        <nav class="flex-1 px-4 space-y-2">
            {{-- ADMIN --}}
            @if(auth()->user()->role === 'admin')
                <x-nav-link route="index.admin" icon="dashboard">Dashboard</x-nav-link>
                <x-nav-link route="index.materias" icon="menu_book">Materias</x-nav-link>
                <x-nav-link route="index.horarios" icon="calendar_today">Horarios</x-nav-link>
                <x-nav-link route="index.grupos" icon="group">Grupos</x-nav-link>
                <x-nav-link route="index.inscripciones" icon="person_add">Inscripciones</x-nav-link>
                <x-nav-link route="index.calificaciones" icon="grade">Calificaciones</x-nav-link>

            {{-- STUDENT --}}
            @elseif(auth()->user()->role === 'student')
                <x-nav-link route="student.dashboard" icon="dashboard">Dashboard</x-nav-link>
                <x-nav-link route="student.grupos" icon="group">Grupos</x-nav-link>
                <x-nav-link route="student.calificaciones" icon="grade">Calificaciones</x-nav-link>
                <x-nav-link route="student.tareas" icon="assignment">Tareas</x-nav-link>

            {{-- TEACHER --}}
            @elseif(auth()->user()->role === 'teacher')
                <x-nav-link route="teacher.dashboard" icon="dashboard">Dashboard</x-nav-link>
                <x-nav-link route="teacher.grupos" icon="group">Grupos</x-nav-link>
                <x-nav-link route="teacher.calificaciones" icon="grade">Calificaciones</x-nav-link>
            @endif

        </nav>

        <!-- USER / LOGOUT -->
        <div class="p-4 border-t border-slate-200">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="text-red-500 hover:text-red-700 text-sm flex align-items gap-3">
                    <span class="material-symbols-outlined">logout</span>Logout
                </button>
            </form>
        </div>
        @else
            <x-nav-link route="index.home" icon="home">Home</x-nav-link>
            <x-nav-link route="index.login" icon="login">Login</x-nav-link>
            <x-nav-link route="index.register" icon="app_registration">Register</x-nav-link>
        @endauth
    </aside>

    {{-- NAVBAR FOR CEL AND TABLET WIDTH--}}
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 z-40 lg:hidden">
        <div class="max-w-7xl mx-auto px-4 flex justify-between">
            @auth
                @if(auth()->user()->role === 'admin')
                    <x-bottom-nav-link route="index.admin" icon="dashboard" label="Dashboard"/>
                    <x-bottom-nav-link route="index.materias" icon="menu_book" label="Materias"/>
                    <x-bottom-nav-link route="index.horarios" icon="calendar_today" label="Horarios"/>
                    <x-bottom-nav-link route="index.grupos" icon="group" label="Grupos"/>
                    <x-bottom-nav-link route="index.inscripciones" icon="person_add" label="Inscripciones"/>
                    <x-bottom-nav-link route="index.calificaciones" icon="grade" label="Calificaciones"/>
                @elseif(auth()->user()->role === 'student')
                    <x-bottom-nav-link route="student.dashboard" icon="dashboard" label="Dashboard"/>
                    <x-bottom-nav-link route="student.grupos" icon="group" label="Grupos"/>
                    <x-bottom-nav-link route="student.calificaciones" icon="grade" label="Calificaciones"/>
                    <x-bottom-nav-link route="student.tareas" icon="assignment" label="Tareas"/>
                @elseif(auth()->user()->role === 'teacher')
                    <x-bottom-nav-link route="teacher.dashboard" icon="dashboard" label="Dashboard"/>
                    <x-bottom-nav-link route="teacher.grupos" icon="group" label="Grupos"/>
                    <x-bottom-nav-link route="teacher.calificaciones" icon="grade" label="Calificaciones"/>
                @endif
            @else
                <x-bottom-nav-link route="index.home" icon="home" label="Home"/>
                <x-bottom-nav-link route="index.login" icon="login" label="Login"/>
                <x-bottom-nav-link route="index.register" icon="app_registration" label="Register"/>
            @endauth
        </div>
    </nav>


    {{-- MAIN --}}
    <main class="flex-1 flex flex-col">

        <!-- HEADER -->
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6">
            <h2 class="font-semibold text-lg">
                @yield('header', 'Dashboard')
            </h2>

            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-slate-500 cursor-pointer">
                    notifications
                </span>

                <!-- LOGOUT ONLY FOR CEL AND TABLET -->
                @auth
                <form action="{{ route('logout') }}" method="post" class="lg:hidden">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 text-red-500 hover:text-red-700">
                        <span class="material-symbols-outlined">logout</span>
                    </button>
                </form>
                @endauth
            </div>
        </header>

        <!-- CONTENT -->
        <div class="p-6">
            @yield('content')
        </div>

        <!-- FOOTER -->
        <footer class="mt-auto p-4 text-center text-sm text-slate-500 border-t">
            © {{ date('Y') }} EduManage
        </footer>

    </main>

</div>
</body>
</html>