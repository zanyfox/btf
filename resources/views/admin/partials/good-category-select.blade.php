<option value="{{$cat->id}}" @isset($good) @selected($good->categories->contains($cat->id)) @endisset>{!! str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level) !!} {{ $cat->name }}</option>
@if($cat->children->count()  > 0 )
  @foreach($cat->children as $category)
  @include('admin.partials.good-category-select', ['cat' => $category, 'level' => $level + 1])
  @endforeach
@endif
