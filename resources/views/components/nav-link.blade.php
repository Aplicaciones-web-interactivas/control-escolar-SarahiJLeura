@props(['route', 'icon', 'active' => false])

@php
$isActive = $active !== false ? $active : request()->routeIs($route);
@endphp

<a href="{{ route($route) }}"
   class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-100 transition {{ $isActive ? 'text-blue-600' : 'text-slate-600' }}">

    <span class="material-symbols-outlined">
        {{ $icon }}
    </span>

    <span class="font-medium">
        {{ $slot }}
    </span>
</a>