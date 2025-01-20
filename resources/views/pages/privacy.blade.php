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
        <section>
          <h3>{{  $page->title}}</h3>
          {!! $page->text !!}
        </section>
      </div>
    </div>
    <div class="about-company-flower">
      <img src="{{ asset('assets/images/fixed-flower.png') }}" alt="">
    </div>
  </div>
</section>
<!-- about-company -->
@endsection
