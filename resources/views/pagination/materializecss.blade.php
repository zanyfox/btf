@if ($paginator->hasPages())
<ul class="pagination">
  @if ($paginator->onFirstPage())
    <li class="disabled"><a href="#!" title="Previous"><i class="material-icons">chevron_left</i></a></li>
  @else
    <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="material-icons">chevron_left</i></a></li>
  @endif
  @foreach ($elements as $element)
    @if (is_string($element))
      <li class="disabled"><span>{{ $element }}</span></li>
    @endif
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
          <li class="active"><a href="#!">{{ $page }}</a></li>
        @else
          <li class="waves-effect"><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
      @endforeach
    @endif
  @endforeach
  @if ($paginator->hasMorePages())
    <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="material-icons">chevron_right</i></a></li>
  @else
    <li class="disabled"><a href="#!" title="Next"><i class="material-icons">chevron_right</i></a></li>
  @endif
</ul>
@endif
