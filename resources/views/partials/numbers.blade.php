<div class="statistics-section__top text-center @if(request()->is('distributors')) mt-0 bg-white @endif">
  <h2 class="sub-title">«Создавая дымные шедевры ...»</h2>
</div>
<section class="statistics-section text-white text-center">
  <div class="container">
    <div class="row">
      @if(isset($settings['brands_count']))
      <div class="col-md-3">
        <h2>{{ $settings['brands_count'] }}</h2>
        <p>брендов</p>
      </div>
      @endif
      @if(isset($settings['distributors_count']))
      <div class="col-md-3">
        <h2>{{ $settings['distributors_count'] }}</h2>
        <p>дистрибьюторов</p>
      </div>
      @endif
      @if(isset($settings['years_count']))
      <div class="col-md-3">
        <h2>{{ date('Y') - 1997 }}</h2>
        <p>лет на рынке</p>
      </div>
      @endif
      @if(isset($settings['employees_count']))
      <div class="col-md-3">
        <h2>{{ $settings['employees_count'] }}</h2>
        <p>сотрудников</p>
      </div>
      @endif
    </div>
  </div>
</section>