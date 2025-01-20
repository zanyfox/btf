<ul class="social-media {{ $class }}">
  @if(isset($settings['vk']) && !empty($settings['vk']))
  <li>
    <a href="{{$settings['vk']}}" target="_blank"><i class="icon icon-vk"></i></a>
  </li>
  @endif
  @if(isset($settings['tg']) && !empty($settings['tg']))
  <li>
    <a href="{{$settings['tg']}}" target="_blank"><i class="icon icon-tg"></i></a>
  </li>
  @endif
  @if(isset($settings['whatsapp']) && !empty($settings['whatsapp']))
  <li>
    <a href="{{$settings['whatsapp']}}" target="_blank"><i class="icon icon-whatsapp"></i></a>
  </li>
  @endif
</ul>
