<x-admin-layout>
  <x-slot:title>@lang('admin.ImportGoods')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/goods')}}">@lang('admin.Goods')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.ImportGoods')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <form action="{{url('admin/goods/import')}}" method="POST" id="importGoodsForm" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="card">
      <div class="card-header">
        <h5>@lang('admin.ImportGoods')</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col col-8">
            <div class="form-group">
              <label for="inputName">@lang('admin.ImportFile')</label>
              <input type="file" name="import_file" class="form-control" id="inputFile">
              @if($errors->has('import_file'))
              <div class="invalid-feedback d-block">{{$errors->first('import_file')}}</div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">@lang('admin.Import')</button>
  </form>
</x-admin-layout>
