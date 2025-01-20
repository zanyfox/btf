<div id="mainModal" class="modal details-modal">
  <div class="modal-overlay"></div>
  <div tabindex="0"></div>
  <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="main-modal-label" aria-describedby="main-modal-description">
    <div class="modal-body">
      <a href="#" role="button" aria-label="Close modal" class="modal-close"></a>
      <div id="main-modal-description" class="modal-content"></div>
    </div>
  </div>
  <div tabindex="0"></div>
</div>

<div id="alertModal" class="modal alert-modal">
  <div class="modal-overlay"></div>
  <div tabindex="0"></div>
  <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="alert-modal-label" aria-describedby="alert-modal-description">
    <div class="modal-body">
      <div id="alert-modal-description" class="modal-content">
        <div id="commonNotification" class="common_notification"></div>
      </div>
    </div>
  </div>
  <div tabindex="0"></div>
</div>

<div id="modifiersModal" class="modal time-modal">
  <div class="modal-overlay"></div>
  <div tabindex="0"></div>
  <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="modifiers-modal-label" aria-describedby="modifiers-modal-description">
    <div class="modal-body">
      <a href="#" role="button" aria-label="Close modal" class="modal-close"></a>
      <div id="modifiers-modal-description" class="modal-content">
        <h4>Выберите <span class="text-success">обязательные</span> ингредиенты</h4>
        <div id="modifiersModalBody"></div>
      </div>
    </div>
  </div>
  <div tabindex="0"></div>
</div>

<div id="timeModal" class="modal time-modal">
  <div class="modal-overlay"></div>
  <div tabindex="0"></div>
  <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="time-modal-label" aria-describedby="time-modal-description">
    <div class="modal-body">
      <a href="#" role="button" aria-label="Close modal" class="modal-close"></a>
      <div id="time-modal-description" class="modal-content">
        <a href="/" class="modal-logo">
          <img src="{{asset('assets/img/logo.svg')}}" width="163" height="118" alt="">
        </a>
        {{-- <p class="text-orange">К сожалению, корзина не работает</p> --}}
        <p class="text-orange">К сожалению, мы еще закрыты!</p>
        <p>Мы откроемся в 11:00 и накормим вас!</p>
      </div>
    </div>
  </div>
  <div tabindex="0"></div>
</div>

<div id="cartoffModal" class="modal time-modal">
  <div class="modal-overlay"></div>
  <div tabindex="0"></div>
  <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="time-modal-label" aria-describedby="time-modal-description">
    <div class="modal-body">
      <a href="#" role="button" aria-label="Close modal" class="modal-close"></a>
      <div id="time-modal-description" class="modal-content">
        <a href="/" class="modal-logo">
          <img src="{{asset('assets/img/logo.svg')}}" width="163" height="118" alt="">
        </a>
        <p class="text-orange">Доставка временно не работает</p>
      </div>
    </div>
  </div>
  <div tabindex="0"></div>
</div>

<div id="loginModal" class="modal login-modal">
  <div class="modal-overlay"></div>
  <div tabindex="0"></div>
  <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="login-modal-label" aria-describedby="login-modal-description">
    <div class="modal-body">
      <a href="#" role="button" aria-label="Close modal" class="modal-close"></a>
      <div id="login-modal-description" class="modal-content">
        <p class="text-orange">Вход на сайт</p>
        <form action="#">
          <div class="form-group">
            <input type="text" name="email" class="form-control" />
          </div>
          <div class="form-group">
            <input type="text" name="email" class="form-control" />
          </div>
          <div class="form-group">
            <input type="text" name="email" class="form-control" />
          </div>
        </form>
        <p>Мы откроемся в 11:00 и накормим вас!</p>
      </div>
    </div>
  </div>
  <div tabindex="0"></div>
</div>

