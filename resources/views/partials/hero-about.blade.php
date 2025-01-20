@php
  if(cache()->has('aboutHero')) {
    $hero = cache()->get('aboutHero');
  } else {
    $hero = \App\Models\Slide::find(5);
    cache()->forever('aboutHero', $hero);
  }
@endphp

@if($hero)
<section class="intro">
  <img class="intro-bg" src="{{ url('uploads/mainslider/' . $hero->picture) }}" alt="{{ $hero->name }}">
  <div class="intro-content">
    <div class="intro-content__info">{{ $hero->tagline }}</div>
    <h1 class="intro-content__title" style="max-width: 890px;">{{ $hero->name }}</h1>
  </div>
</section>
@endif