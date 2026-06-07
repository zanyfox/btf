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
<li @if(Request::input('category') == $category->id)class="active"@endif>
  <a href="{{url('admin/goods?category=' . $category->id )}}">{{ $category->name }}</a>
  @if ($category->children()->count() > 0 )
  <ul class="ml-3">
    @include('admin.partials.category', ['categories' => $category->children])
  </ul>
  @endif
</li>
@endforeach
