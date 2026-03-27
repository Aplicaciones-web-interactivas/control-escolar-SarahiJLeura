@props(['route', 'icon', 'label', 'active' => false])

@php
$isActive = $active !== false ? $active : request()->routeIs($route);
@endphp

<a href="{{ route($route) }}" class="flex flex-col items-center py-3 px-4 {{ $isActive ? 'text-blue-600' : 'text-slate-400' }}">
    <span class="material-symbols-outlined">{{ $icon }}</span>
    <span class="text-[10px] mt-1 font-medium">{{ $label }}</span>
</a>
