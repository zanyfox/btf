@section('title', __('admin.CreateCoupon'))
<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/coupons')}}">@lang('admin.Coupons')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.CreateCoupon')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      @if($errors->any())
      <div class="alert alert-danger">
        <ul class="list-unstyled mb-0">
          @foreach($errors->all() as $error)
          <li class="red-text">{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form action="{{route('admin.coupons.store')}}" method="POST" id="createCouponForm" novalidate>
        @csrf
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.CreateCoupon')</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputCode">@lang('admin.CouponCode')</label>
                  <input type="text" name="code" value="{{old('code')}}" class="form-control" id="inputCode" autocomplete="code" autofocus placeholder="@lang('admin.CouponCode')">
                  <div class="d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputName">@lang('admin.CouponName')</label>
                  <input type="text" name="name" value="{{old('name')}}" class="form-control" id="inputName" placeholder="@lang('admin.CouponName')">
                </div>
                <div class="form-group">
                  <label for="inputDescription">@lang('admin.Description')</label>
                  <textarea id="inputDescription" name="description" rows="6" class="form-control">{{old('description')}}</textarea>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="inputStartedAt">@lang('admin.StartsAt')</label>
                    <input type="date" name="started_at" class="form-control" id="inputStartedAt" autocomplete="off">
                    <div class="d-block"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputExpiredAt">@lang('admin.ExpiresAt')</label>
                    <input type="date" name="expired_at" class="form-control" id="inputExpiredAt" autocomplete="off">
                    <div class="d-block"></div>
                  </div>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group mt-4">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" @checked(true) class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">@lang('admin.ActiveStatus')</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="only_once" @checked(false) class="custom-control-input" id="inputOnlyOnce">
                    <label class="custom-control-label" for="inputOnlyOnce">@lang('admin.OnlyOnce')</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputType">@lang('admin.Type')</label>
                  <select name="type" class="form-control" id="inputType">
                    <option value="fixed" selected>@lang('admin.Fixed')</option>
                    <option value="percent">@lang('admin.Percent')</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputCouponValue">@lang('admin.CouponValue')</label>
                  <input type="number" name="value" value="{{old('value')}}" class="form-control" id="inputCouponValue">
                  <div class="d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputMinSum">@lang('admin.MinSum')</label>
                  <input type="number" name="min_sum" value="{{old('min_sum')}}" class="form-control" id="inputMinSum">
                </div>
                <div class="form-group">
                  <label for="inputCurrency">@lang('admin.Currency')</label>
                  <select name="currency_id" class="form-control" id="inputCurrency" disabled>
                    <option value="" selected>Не выбрано</option>
                    @foreach($currencies as $currency)
                    <option value="{{$currency['id']}}">{{$currency['name']}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">@lang('admin.Create')</button>
        <button type="button" data-url="{{ url('admin/coupons') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">@lang('admin.Cancel')</button>
      </form>
    </div>
  </div>
</x-admin-layout>