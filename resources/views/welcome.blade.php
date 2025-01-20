<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Подтверждение возраста</title>
  @include('partials.styles')
</head>
<body>
  <div class="wrapper">
    <div class="wellcome">
      <div class="wellcome-content">
        <img src="{{ asset('assets/images/company-logo.svg') }}" alt="">
        <div class="info-box">
          <div class="age-box">18+</div>
          <h3>Подтверждение возраста</h3>
          <p>Нажимая кнопку “Войти на сайт” Вы подстверждаете, что вам 18 лет</p>
          <div class="form-check text-start mx-auto form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">Я подтверждаю, что мне есть 18 лет</label>
          </div>
          <button type="button" disabled class="yellow-btn bg-transparent" id="btnEnter">ВОЙТИ НА САЙТ</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.querySelector('#flexSwitchCheckDefault').addEventListener('change', function() {
      if(this.checked) {
        document.querySelector('#btnEnter').removeAttribute('disabled')
      } else {
        document.querySelector('#btnEnter').setAttribute('disabled', true)
      }
    })
    document.querySelector('#btnEnter').addEventListener('click', function() {
      document.cookie = `age_limit=true; path=/; max-age=${60*60*24};`
      location.reload()
    })
  </script>
</body>
</html>
