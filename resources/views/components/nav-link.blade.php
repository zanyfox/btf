@props(['active','href'])

@php
$classes = ($active ?? false) ? 'active' : '';
@endphp


{{-- @if(request()->is('/')) active @endif --}}
{{-- {{URL::current()}} --}}

<li class="{{$classes}}">
  <a {{ $attributes->merge(['href' => $href]) }}>
    {{ $slot }}
  </a>
</li>
