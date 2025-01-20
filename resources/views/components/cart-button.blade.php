@props(['count'])

@php
$count = $count ?? 1
@endphp

<a class="btn nav-link cart-btn" href="/cart">
  <i class="far fa-shopping-cart fa-fw"></i>
  <span class="badge badge-info">{{$count}}</span>
  <span class="sr-only">{{ $slot }}</span>
</a>
