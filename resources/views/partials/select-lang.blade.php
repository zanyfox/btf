@php
  $langs = ['ru', 'en'];   
@endphp
<select onchange="if(this.value != 'ru') {
  window.location.href = window.location.protocol + '/\/' + window.location.host + '/' + this.value + '/home'
} else {
  window.location.href = window.location.origin + '/home'
};">
  @foreach ($langs as $lang)
    <option value="{{ $lang }}" @if($lang == 'ru') selected @endif>{{ strtoupper($lang) }}</option>
  @endforeach
</select>