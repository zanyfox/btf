@props(['name', 'slug','tagline','excerpt','preview'])
<div class="card-sale">
  <a href="{{url('promotions/' . $slug)}}" class="card-sale-header">
    <span class="label">{{$tagline}}</span>
    @if($preview)
    <img src="{{asset('storage/' . $preview)}}" alt="{{$name}}">
    @endif
  </a>
  <div class="card-sale-body">
    <h3><a href="{{url('promotions/' . $slug)}}">{{$name}}</a></h3>
    <p>{{$excerpt}}</p>
    <a href="{{url('promotions/' . $slug)}}" class="readmore">@lang('Details')</a>
  </div>
</div>
