<option value="{{$cat->id}}" @selected(isset($current) && $current->parent_id === $cat->id)>{!! str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level) !!} {{ $cat->name }}</option>
@if ($cat->children->count() > 0 )
  @foreach($cat->children as $category)
  @include('admin.partials.category-select', ['cat' => $category, 'level' => $level + 1])
  @endforeach
@endif
