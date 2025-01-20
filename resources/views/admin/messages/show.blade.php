<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/messages')}}">{{ __('admin.Messages') }}</a></li>
            <li class="breadcrumb-item"><a href="#!">{{ __('admin.ShowMessage') }}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header">
          <h5>{{ __('admin.ShowMessage') }}</h5>
          <a href="javascript:void(0); window.print()" class="btn btn-sm btn-default float-right"><i class="feather icon-printer"></i> Печать</a>
        </div>
        <div class="card-body">
          <p>Имя: <b>{{ $message->name }}</b></p>
          <p>Телефон: <b>{{ $message->phone }}</b></p>
          <p>Email: <b>{{ $message->email }}</b></p>
          <p>Текст сообщения:</p>
          <div>
            {!! $message->content !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>
