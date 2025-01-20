@props(['socialLinks'])
@php
$socialLinks = [
  /* ['name' => 'pinterest', 'url' => '#', 'icon' => 'fab fa-pinterest-p'],
  ['name' => 'rss', 'url' => '#', 'icon' => 'fas fa-rss'],
  ['name' => 'linkedin', 'url' => '#', 'icon' => 'fab fa-linkedin-in'],
  ['name' => 'google', 'url' => '#', 'icon' => 'fab fa-google-plus-g'],
  ['name' => 'facebook', 'url' => '#', 'icon' => 'fab fa-facebook-f'], */
  ['name' => 'twitter', 'url' => '#', 'icon' => 'fab fa-telegram']
];
@endphp
<ul class="social-share list-inline mb-0 text-lg-right">
  @foreach($socialLinks as $socialLink)
  <li>
    <a class="{{$socialLink['name']}}" href="{{$socialLink['url']}}">
      <i class="{{$socialLink['icon']}}"></i>
    </a>
  </li>
  @endforeach
</ul>
