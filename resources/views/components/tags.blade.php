@props(['tagsCsv'])
@php
$tags = explode(',', $tagsCsv);
@endphp
<ul class="tags roboto list-inline mb-lg-0 mb-md-3">
  <li><i class="fas fa-tags"></i></li>
  @foreach($tags as $tag)
  <li><a href="/blog?tag={{Str::lower($tag)}}">#{{$tag}}</a></li>
  @endforeach
</ul>
