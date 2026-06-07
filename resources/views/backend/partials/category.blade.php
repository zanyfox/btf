{{-- <li  class="@if($category->parent_id == 0 ) list-group-item  @endif @if(Request::is( 'catalog/' . $category->slug)) active @endif">
  <a href="{{ url('catalog', $category->slug) }}">{{ $category->name }}</a>
  @if ($category->children()->count() > 0 )
  <ul>
    @foreach($category->children as $category)
      @include('partials.category', $category)
    @endforeach
  </ul>
  @endif
</li> --}}

@foreach($categories as $category)
<li class="pc-item pc-hasmenu @if(Request::input('category') == $category->id) active @endif">
  <router-link class="pc-link" to="/backend/goods?category={{$category->id}}">{{ $category->name }} <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span
    ></router-link>
  @if ($category->children()->count() > 0 )
  <ul class="pc-submenu">
    @include('backend.partials.category', ['categories' => $category->children])
  </ul>
  @endif
</li>
@endforeach
