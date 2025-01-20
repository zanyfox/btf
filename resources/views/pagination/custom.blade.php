@if ($paginator->hasPages())
<ul class="pagination">
  @if ($paginator->onFirstPage())
    <li class="float-left disabled"><span><i class="icon icon-prev"></i></span></li>
  @else
    <li class="float-left"><a href="{{ $paginator->previousPageUrl() }}" rel="prev" title="Prev"><i class="icon icon-prev"></i></a></li>
  @endif
  @foreach ($elements as $element)
    @if (is_string($element))
      <li class="disabled"><span>{{ $element }}</span></li>
    @endif
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
          <li class="active"><a href="#">{{ $page }}</a></li>
        @else
          <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
      @endforeach
    @endif
  @endforeach
  @if ($paginator->hasMorePages())
    <li class="float-right"><a href="{{ $paginator->nextPageUrl() }}" rel="next" title="Next"><i class="icon icon-next"></i></a></li>
  @else
    <li class="float-right disabled"><span><i class="icon icon-next"></i></span></li>
  @endif
</ul>
@endif

{{-- <ul class="pagination">
  <li><a href=""><i class="icon icon-prev"></i></a></li>
  <li class="active"><a href="">1</a></li>
  <li><a href="">2</a></li>
  <li><a href="">3</a></li>
  <li><a href=""><i class="icon icon-next"></i></a></li>
</ul>
 --}}