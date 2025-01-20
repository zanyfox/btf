<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">Экспорт заказов в iiko</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header">
          <h5>Экспорт заказов в iiko</h5>
        </div>
        <div class="card-body table-border-style">
          @if($logs->isNotEmpty())
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>ID заказа на сайте</th>
                  <th>ID заказа в iiko</th>
                  <th>Запрос в iiko</th>
                  <th>Ответ от iiko</th>
                  <th>{{__('admin.CreatedAt')}}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($logs as $log)
                <tr>
                  <td>{{$log->id}}</td>
                  <td>{{$log->name}}</td>
                  <td>{{$log->description}}</td>
                  <td>{{$log->request}}</td>
                  <td>{{$log->response}}</td>
                  <td>{{$log->created_at->format('d.m.Y H:i:s')}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {{$logs->links()}}
          @else
          <p class="center-align red-text">{{__('admin.RecordsNotFound')}}</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>