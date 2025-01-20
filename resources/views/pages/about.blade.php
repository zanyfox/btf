@extends('layouts/app')

@section('title', $page->metatitle ?? $page->title)
@section('keywords', $page->keywords)
@section('description', $page->description)

@section('content')

<script src="{{asset('assets/js/htmx.min.js')}}"></script>
<script>
  document.body.addEventListener('htmx:configRequest', (event) => {
    event.detail.headers['X-Requested-With'] = 'XMLHttpRequest'
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    event.detail.headers['X-CSRF-TOKEN'] = token
  })
</script>

<!-- about-company -->
<section class="about-company">
  <div class="container">
    <div class="about-company-content">
      <img class="line-img d-md-block d-none" src="{{ asset('assets/images/big-line.svg') }}" alt="">
      <svg class="line-img media-line__img" width="310" height="29" viewBox="0 0 310 29" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <line y1="13.6421" x2="223.431" y2="13.6421" stroke="#AFB0B0" />
        <rect x="234.139" y="14.1421" width="9" height="9" transform="rotate(-45 234.139 14.1421)" fill="#AFB0B0"
          stroke="#AFB0B0" />
        <rect x="258.281" y="14.1421" width="19" height="19" transform="rotate(-45 258.281 14.1421)"
          fill="#AFB0B0" stroke="#AFB0B0" />
        <rect x="296.565" y="14.1421" width="9" height="9" transform="rotate(-45 296.565 14.1421)" fill="#AFB0B0"
          stroke="#AFB0B0" />
      </svg>
      <div class="about-company-content">
        @isset($custom['text-1'])
        <section>
          <h3>{{  $custom['text-1']->title}}</h3>
          {!! $custom['text-1']->body !!}
        </section>
        @endisset
        @isset($custom['text-2'])
        <section>
          <h3>{{  $custom['text-2']->title}}</h3>
          {!! $custom['text-2']->body !!}
        </section>
        @endisset
        @isset($custom['text-3'])
        <section>
          <h3>{{  $custom['text-3']->title}}</h3>
          {!! $custom['text-3']->body !!}
        </section>
        @endisset
        @isset($custom['text-4'])
        <section>
          <h3>{{  $custom['text-4']->title}}</h3>
          {!! $custom['text-4']->body !!}
        </section>
        @endisset
      </div>
      @isset($custom['text-5'])
      <section>
        <h3>{{  $custom['text-5']->title}}</h3>
        {!! $custom['text-5']->body !!}
      </section>
      @endisset
      @isset($custom['text-6'])
      <section>
        <h3>{{  $custom['text-6']->title}}</h3>
        {!! $custom['text-6']->body !!}
      </section>
      @endisset
    </div>
    <div class="about-company-flower">
      <img src="{{ asset('assets/images/fixed-flower.png') }}" alt="">
    </div>
  </div>
</section>
<!-- about-company -->

{{-- <div id="source">
  source
</div>
<div id="destination">
  destination
</div>

<script>
  let source = document.querySelector('#source');
  let destination = document.querySelector('#destination');

  // Move stuff
  destination.append(source)
  //$("#source").detach().prependTo("#destination");
</script>
 --}}
<!-- About tobacco -->
<section class="about-tobacco">
  <div hx-get="/about-tobacco" hx-trigger="load" class="container">
    <div class="text-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>
</section>
<style>
.htmx-settling .spinner-border {
  opacity: 0;
}
.spinner-border {
 transition: opacity 300ms ease-in;
}
</style>
@endsection
