{{-- @php
$currencies = \App\Services\CurrencyConversion::getCurrencies();    
@endphp --}}
@isset($currencies)
<style>
  .currency-list {display: flex; gap: 10px;}
  .currency-list li.active a {color: gold;}
</style>
<div>
  <ul class="{{ $class }}">
    @foreach($currencies as $currency)
    <li @if(session('currency', 'RUB') == $currency->code) class="active" @endif><a href="{{ route('changeCurrency', $currency->code) }}">{{ $currency->symbol }}</a></li>
    @endforeach
  </ul>
</div>
@endisset