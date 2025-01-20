<x-admin-layout>
  @section('title', __('admin.Orders'))
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.Orders')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <x-flash-message />
      <div class="card card-table">
        <div class="card-header">
          <h5>Фильтрация заказов</h5>
          <div class="card-header-right">
            <div class="btn-group card-option">
              <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="feather icon-more-horizontal"></i>
              </button>
              <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="" method="GET">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputFilterSearch">@lang('admin.SearchByTitle')</label>
                <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control" id="inputFilterSearch">
              </div>
              <div class="form-group col-md-4">
                <label for="inputFilterDate">@lang('admin.FilterByDate')</label>
                <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control" id="inputFilterDate">
              </div>
              <div class="form-group col-md-4">
                <label for="inputFilterStatus">@lang('admin.FilterByStatus')</label>
                <select name="status" class="form-control" id="inputFilterStatus">
                  <option value="">{{__('admin.SelectVariant')}}</option>
                  @foreach (\App\Enums\OrderStatus::cases() as $status)
                  <option value="{{$status->value}}" @selected(Request::get('status') === $status->value)>{{__('admin.' . $status->name)}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Фильтровать</button>
            @if(Request::get('search'))
            <button type="button" data-url="{{ url('admin/orders') }}" onclick="if(!confirm('Вы уверены, что сбросить фильтры?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">{{__('admin.Reset')}}</button>
            @endif
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h5>{{__('admin.OrdersList')}}</h5>
          {{-- <a href="{{route('admin.orders.create')}}" data-toggle="tooltip" data-placement="top" title="{{__('Create New Order')}}" class="btn btn-sm btn-primary float-right">
            <i class="feather icon-plus"></i> Новая заказ
          </a> --}}
        </div>
        <div class="card-body table-border-style">
          @if($orders->isNotEmpty())
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>@lang('admin.Customer')</th>
                  <th>Email</th>
                  <th>@lang('admin.Phone')</th>
                  <th>@lang('admin.Status')</th>
                  <th>@lang('admin.Amount')</th>
                  <th>@lang('admin.OrderedDate')</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
                <tr @if(!$order->isAvailable()) class="table-danger" @endif>
                  <td><a href="{{route('admin.orders.edit', [$order->id,'preview' => true])}}">{{$order->id}}</a></td>
                  <td><a href="{{url('/admin/users/' . $order->user->id)}}" target="_blank">{{$order->user->name}}</a></td>
                  <td>{{$order->email}}{{-- {{$order->user->email}} --}}</td>
                  <td>{{$order->phone}}{{-- {{$order->user->phone}} --}}</td>
                  <td>
                    <select class="selectChangeOrderStatus form-control form-control-sm" data-id="{{$order->id}}">
                      @foreach (\App\Enums\OrderStatus::cases() as $status)
                      <option value="{{$status->value}}" @selected($order->status->value === $status->value)>{{__('admin.' . $status->name)}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>{{number_format($order->grand_total, 0, '.', ' ')}} {{ $order->currency->symbol }}</td>
                  <td>
                    {{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y H:s')}}
                    @if($order->deleted_at)
                    <br>Удалено: {{ $order->deleted_at->format('d.m.Y H:s') }}
                    @endif
                  </td>
                  <td class="text-right">

                    @if(!$order->deleted_at)
                      <a href="{{route('admin.orders.show', $order->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Show')" class="btn btn-sm btn-info"><i class="feather icon-eye"></i></a>
                      @can('isAdmin')
                        <button type="button" onclick="deleteRecord({{$order->id}})" data-toggle="tooltip" data-placement="top" title="@lang('admin.Delete')" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                      @endcan
                    @else
                      @can('isAdmin')
                        <a href="{{route('admin.orders.restore', $order->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('admin.Restore')" class="btn btn-sm btn-info"><i class="feather icon-repeat"></i></a>
                      @endcan
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>  
            </table>
          </div>
          {{$orders->appends(request()->input())->links()}}
          @else
          <p class="center-align red-text">@lang('admin.RecordsNotFound')</p>
          @endif
      </div>
    </div>
  </div>
  @push('scripts')
  <script>
    const selectChangeOrderStatus = document.querySelectorAll('.selectChangeOrderStatus')
    if(selectChangeOrderStatus) {
      selectChangeOrderStatus.forEach(select => {
        let id = select.dataset.id
        select.onchange = function() {
          fetch('/admin/orders/change-status/' + id, {
            method: 'PATCH',
            headers: {
              'Content-type': 'application/x-www-form-urlencoded',
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: 'status='+this.value
          }).then(res => res.json()).then(data => {
            $('.toast .toast-body').text(data.message)
            $('.toast').toast('show')
          }).catch(err => console.error(err.message))
        }
      })
    }

    function deleteRecord(id) {
      if(confirm('Are you sure you want to delete?')) {
        fetch('/admin/orders/' + id, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json()).then(data => {
          if(data.status == 'success') {
            window.location.href = '/admin/orders'
          }
        })
        .catch(err => console.error(err.message))
      }
    }
  </script>
  @endpush
</x-admin-layout>
