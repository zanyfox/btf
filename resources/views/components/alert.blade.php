@props(['message', 'type', 'address'])
<div {{ $attributes->merge(['class' => 'alert alert-']) }}>
  {{ $message ?? $slot }} <b>{{ $address }}</b>
</div>