@extends('layouts/app')

@section('title', $rubric->name)
@section('keywords', $rubric->keywords)
@section('description', $rubric->description)

@section('content')
<section id="sales">
  <div class="greyblue-rectangle no-width has_transition_2000_expo"></div>
  <div class="lightyellow-rectangle"></div>
  <div class="container">
    <div class="content pb-0">
      {{ Breadcrumbs::render('rubric', $rubric) }}
      <h1>{{ $rubric->name }}</h1>
      @if(count($rubric->posts) > 0)
      <div class="grid-container">
        @foreach($rubric->posts as $promotion)
        <div class="grid-item {{$loop->even ? 'even' : 'odd'}}">
          {{-- <x-card name="{{$promotion->name}}" :slug="$promotion->slug" :excerpt="$promotion->excerpt" :tagline="$promotion->tagline" :preview="$promotion->preview" /> --}}
          <div class="card-sale">
            <a href="{{url('promotions/' . $promotion->slug)}}" class="card-sale-header">
              <span class="label">{{$promotion->tagline}}</span>
              @if($promotion->preview)
              <img src="{{asset('storage/' . $promotion->preview)}}" alt="{{$promotion->name}}">
              @endif
            </a>
            <div class="card-sale-body">
              <h3><a href="{{url('promotions/' . $promotion->slug)}}">{{$promotion->name}}</a></h3>
              <p>{{$promotion->excerpt}}</p>
              <a href="{{url('promotions/' . $promotion->slug)}}" class="readmore">@lang('Details')</a>
            </div>
        </div>
        @endforeach
      </div>
      {{-- {{ $promotions->links('pagination.custom') }} --}}
      @endif
      @empty($rubric->posts)
      <p class="text-center text-danger">@lang('NoPostsFound')</p>
      @endempty
    </div>
  </div>
</section>
@endsection
