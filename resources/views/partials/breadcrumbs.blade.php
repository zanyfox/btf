{{-- @if(isset($links))
<ul class="breadcrumb">
  @foreach($links as $link)
    @if ($loop->last)
    <li><span>{{ $link['title'] }}</span></li>
    @else
    <li><a href="{{ $link['slug'] }}">{{ $link['title'] }}</a></li>
    @endif
  @endforeach
</ul>
@endif --}}

@if(isset($breadcrumbs))
@unless ($breadcrumbs->isEmpty())
  <ol class="breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
      @if (!is_null($breadcrumb->url) && !$loop->last)
      <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
      @else
      <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
      @endif
    @endforeach
  </ol>
@endunless
@endif