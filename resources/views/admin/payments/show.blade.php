<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/payments')}}">{{ __('admin.Payments') }}</a></li>
            <li class="breadcrumb-item"><a href="#!">{{ __('admin.ShowPayment') }}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header">
          <h5>{{ __('admin.ShowPayment') }}</h5>
          <a href="javascript:void(0); window.print()" class="btn btn-sm btn-default float-right"><i class="feather icon-printer"></i> Печать</a>
          @if($payment->paymentid)
          <a href="javascript:void(0);" onclick="getPaymentInfo({{ $payment->paymentid }})" class="btn btn-sm btn-default float-right"><i class="feather icon-refresh-ccw"></i> Обновить</a>
          @endif
        </div>
        <div class="card-body">
          <p>Номер заказа: <b>{{ $payment->orderid }}</b></p>
          <p>Уникальный номер платежа: <b>{{ $payment->paymentid }}</b></p>
          <p>Фамилия Имя Отчество: <b>{{ $payment->clientid }}</b></p>
          <p>Сумма платежа: <b>{{ $payment->sum }}</b></p>
          <p>Цифровая подпись запроса: <b>{{ $payment->key }}</b></p>
          <p>Идентификатор платежной системы: <b>{{ $payment->ps_id }}</b></p>
          <p>Адрес электронной почты: <b>{{ $payment->client_email }}</b></p>
          <p>Телефон: <b>{{ $payment->client_phone }}</b></p>
          <p>Наименование услуги: <b>{{ $payment->service_name }}</b></p>
          <p>Замаскированный номер карты: <b>{{ $payment->card_number }}</b></p>
          <p>Держатель карты: <b>{{ $payment->card_holder }}</b></p>
          <p>Срок действия карты: <b>{{ $payment->card_expiry }}</b></p>
          <p>Дата: <b>{{ $payment->obtain_datetime }}</b></p>
          <p>RRN: <b>{{ $payment->RRN }}</b></p>
          <p>APPROVAL_CODE: <b>{{ $payment->APPROVAL_CODE }}</b></p>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
  <script>
    function getPaymentInfo(paymentid) {
      if(paymentid) {
        fetch('/admin/payments/get-payment-info/' + paymentid).then(res => res.json()).then(data => {
          console.log(data)
        }).catch(err => console.log(err.message))
      }
    }
  </script>
  @endpush
</x-admin-layout>
