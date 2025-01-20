@if ($paginator->hasPages())
<ul class="pagination justify-content-end">
  @if ($paginator->onFirstPage())
    <li class="float-left disabled"><a href="#"><i class="fas fa-caret-left"></i> Prev</a></li>
  @else
    <li class="float-left"><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-caret-left"></i> Prev</a></li>
  @endif
  @foreach ($elements as $element)
    @if (is_string($element))
      <li class="disabled"><span>{{ $element }}</span></li>
    @endif
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
          <li class="active"><a href="#">0{{ $page }}</a></li>
        @else
          <li><a href="{{ $url }}">0{{ $page }}</a></li>
        @endif
      @endforeach
    @endif
  @endforeach
  @if ($paginator->hasMorePages())
    <li class="float-right"><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next <i class="fas fa-caret-right"></i></a></li>
  @else
    <li class="float-right disabled"><a href="#">Next <i class="fas fa-caret-right"></i></a></li>
  @endif
</ul>

@endif
