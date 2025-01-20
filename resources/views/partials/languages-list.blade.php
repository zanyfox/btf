<style>
  .languages-list {display: flex; gap: 10px;}
  .languages-list li.active a {color: gold;}
</style>
<div>
  <ul class="{{ $class }}">
    @foreach (Lang::cases() as $lang)
    <li @if(session('lang', 'ru') == $lang->value) class="active" @endif><a href="{{ route('changeLocale', $lang->value) }}">{{$lang->value}}</a></li>
    @endforeach
  </ul>
</div>