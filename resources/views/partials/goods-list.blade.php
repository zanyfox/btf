<section class="brands">
  <div class="container">
    <div class="title-box d-flex align-items-center justify-content-between">
      <h2 class="title-text">Бренды</h2>
      <a class="yellow-btn" href="{{route('catalog')}}">В КАТАЛОГ</a>
    </div>
    <div class="brands-swiper">
      <div class="swiper products-swiper">
        <div class="swiper-wrapper align-items-center">
          @foreach($goods as $good)
          <div class="swiper-slide">
			      @if($good->pictures->first())
              <img class="product-img" src="{{ url('uploads/goods/small/' . $good->pictures->first()->path) }}" alt="{{ $good->__('name') }}">
			      @endif
          </div>
          @endforeach
        </div>
      </div>
      <button class="products-swiper__next">
        <img src="{{asset('assets/images/next-icon.svg')}}" alt="">
      </button>
      <button class="products-swiper__prev">
        <img src="{{asset('assets/images/next-icon.svg')}}" alt="">
      </button>
    </div>
    <a class="yellow-btn d-md-none d-flex mx-auto" href="{{route('catalog')}}">В КАТАЛОГ</a>
  </div>
</section>
