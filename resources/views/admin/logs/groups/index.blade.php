<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">Импорт разделов</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header">
          <h5>Импорт разделов</h5>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table class="table table-striped" id="dataTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Дата обновления меню</th>
                  <th>Дата импорта</th>
                </tr>
              </thead>
              <tbody>
                @foreach($logs as $log)
                <tr>
                  <td>
                    <a href="/admin/logs/groups/{{$log->id}}">{{$log->id}}</a>
                  </td>
                  <td>{{$log->created_at->format('d.m.Y H:i:s')}}</td>
                  <td>{{$log->created_at->format('d.m.Y H:i:s')}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>