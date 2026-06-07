<footer class="footer">
  <img class="footer-flower" src="{{asset('assets/images/footer-flower.png')}}" alt="">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <img class="footer-logo" src="{{asset('assets/images/company-logo.svg')}}" alt="" width="140" height="110">
        <p>
		  Курение вредит Вашему здоровью. {{ date('Y') }} © Общество с ограниченной ответственностью «Балтийская Табачная Фабрика». Доступ на веб-сайт разрешен только гражданам РФ старше 18 лет.
        </p>
      </div>
      <div class="col-lg-6">
        <div class="row justify-content-end">
          <div class="col-md-6">
            <h4>МЕНЮ</h4>
            <ul>
              <li>
                <a class="@if(request()->routeIs('catalog')) active @endif" href="{{ URL::route('catalog') }}">Каталог</a>
              </li>
              <li>
                <a class="@if(request()->routeIs('about')) active @endif" href="{{ URL::route('about') }}">О компании</a>
              </li>
              <li>
                <a class="@if(Request::is('distributors')) active @endif" href="{{ url('distributors') }}">Дистрибьюторы</a>
              </li>
              <li>
                <a class="@if(request()->routeIs('contacts')) active @endif" href="{{ URL::route('contacts') }}">Контакты</a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4>КОНТАКТЫ</h4>
            <ul>
              @if(isset($settings['phone']))
              <li>
                <a href="tel:{{ $settings['phone'] }}">{{ Helper::region_phone_format($settings['phone']) }}</a>
              </li>
              @endif
			  {{--
              @if(isset($settings['phone2']))
              <li>
                <a href="tel:{{ $settings['phone2'] }}">{{ Helper::region_phone_format($settings['phone2']) }}</a>
              </li>
              @endif
              @if(isset($settings['mobile']))
              <li>
                @php
                  $mobile = new \Propaganistas\LaravelPhone\PhoneNumber($settings['mobile'], 'RU');
                @endphp
                <a href="tel:{{ $mobile }}">{{ Helper::phone_format($mobile) }}</a>
              </li>
              @endif
			  --}}
              @if(isset($settings['email']))
              <li>
                <a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>
              </li>
              @endif
            </ul>
          </div>
        </div>
      </div>
      <p class='d-md-none'>
        Курение вредит Вашему здоровью. {{ date('Y') }} © Общество с ограниченной ответственностью «Балтийская Табачная
        Фабрика». Доступ на веб-сайт разрешен только гражданам РФ старше 18 лет, являющимся потребителями сигарет, с
        компьютеров, находящихся в интернет-сети РФ.
      </p>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <a href="{{ url('politika-konfidentsialnosti') }}">Политика конфиденциальности</a>
          <a href="{{ url('polzovatelskoe-soglashenie') }}">Обработка персональных данных</a>
        </div>
        <div class="col-6">
          <a href="{{ url('distributors') }}">Стать партнером</a>
        </div>
      </div>
    </div>
  </div>
</footer>
