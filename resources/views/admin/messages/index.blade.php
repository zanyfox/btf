<x-admin-layout>
  @section('title', __('admin.Messages'))
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">{{ __('admin.Messages') }}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <x-flash-message />
      <div class="card">
        <div class="card-header">
          <h5>{{__('admin.MessagesList')}}</h5>
        </div>
        <div class="card-body table-border-style">
          @if($messages->isNotEmpty())
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Имя отправителя</th>
                  <th>{{__('admin.Phone')}}</th>
                  <th>Email</th>
                  <th>{{__('admin.Status')}}</th>
                  <th>{{__('admin.CreatedAt')}}</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($messages as $message)
                <tr>
                  <td>{{$message->id}}</td>
                  <td>{{$message->name}}</td>
                  <td>{{$message->phone}}</td>
                  <td>{{$message->email}}</td>
                  <td>{{$message->status}}</td>
                  <td>{{ $message->created_at }}</td>
                  <td class="text-right">
                    <a href="{{url('admin/messages/' . $message->id)}}" class="btn btn-sm btn-info"><i class="feather icon-eye"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>  
            </table>
          </div>
          {{$messages->links()}}
          @else
          <p class="center-align red-text">{{__('admin.RecordsNotFound')}}</p>
          @endif
      </div>
    </div>
  </div>
</x-admin-layout>
