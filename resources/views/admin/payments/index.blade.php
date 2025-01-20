<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">{{ __('admin.Payments') }}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header">
          <h5>{{ __('admin.Payments') }}</h5>
        </div>
        <div class="card-body table-border-style">
          <form class="form-inline float-left">
            <div class="form-group mb-2">
              <label for="inputPerPage" class="mr-1">@lang('admin.Show')</label>
              <select class="form-control form-control-sm mr-1" id="inputPerPage">
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select>
              <label>записей</label>
            </div>
          </form>
          <form method="GET" class="form-inline float-right">
            <div class="form-group mb-2">
              <label for="inputSearch" class="mr-2">@lang('admin.Search')</label>
              <input type="search" name="search" value="{{ Request::get('search') }}" class="form-control form-control-sm" id="inputSearch" placeholder="Поиск по имени, email, телефону...">
            </div>
          </form>
          <div class="table-responsive">
            <table class="table table-striped" id="settingsTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{__('admin.OrderNumber')}}</th>
                  <th>{{__('admin.Amount')}}</th>
                  <th>{{__('admin.Phone')}}</th>
                  <th>Email</th>
                  <th>{{__('admin.CreatedAt')}}</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($payments as $payment)
                <tr>
                  <td>{{ $payment->id }}</td>
                  <td>{{ $payment->orderid }}</td>
                  <td>{{ $payment->sum }}</td>
                  <td>{{ $payment->client_phone }}</td>
                  <td>{{ $payment->client_email }}</td>
                  <td>{{ $payment->created_at }}</td>
                  <td class="text-right">
                    <a href="{{url('admin/payments/' . $payment->id)}}" class="btn btn-sm btn-info"><i class="feather icon-eye"></i></a>
                  </td>
                </tr>    
                @endforeach
              </tbody>
            </table>
          </div>
          {{ $payments->appends(request()->input())->links() }}
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>
