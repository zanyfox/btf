<x-admin-layout>
  <x-slot:title>@lang('admin.EditSlide')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/mainslider')}}">@lang('admin.MainSlider')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.EditSlide')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{ url('admin/mainslider/' . $slide->id)}}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.EditSlide')</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName" class="active">@lang('admin.Name')</label>
                  <input type="text" name="name" class="form-control" value="{{$slide->name}}" id="inputName" autofocus>
                  @if ($errors->has('name'))
                  <div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="inputTagline">{{__('admin.Tagline')}}</label>
                  <input type="text" name="tagline" class="form-control" value="{{$slide->tagline}}" id="inputTagline">
                </div>

                <div class="form-group">
                  <label for="inputDescription">{{__('admin.Description')}}</label>
                  <textarea id="inputDescription" name="description" rows="3" class="form-control hasEditor">{{$slide->description}}</textarea>
                </div>
                <div class="form-group">
                  <label for="inputLink">@lang('admin.Link')</label>
                  <input type="url" name="link" class="form-control" value="{{$slide->link}}" id="inputLink">
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" @checked(old('status', $slide->status)) class="custom-control-input" id="customCheckStatus">
                    <label class="custom-control-label" for="customCheckStatus">{{__('admin.ActiveStatus')}}</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputLang">{{__('admin.SelectLanguage')}}</label>
                  <select name="lang" class="form-control" id="inputLang">
                    <option value="" disabled selected>{{__('admin.ChooseLanguage')}}</option>
                    @foreach (Lang::cases() as $lang)
                    <option value="{{$lang->value}}"  @selected($slide->lang == $lang->value)>{{$lang->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputOrderBy">{{__('admin.OrderBy')}}</label>
                  <input type="number" name="order_by" class="form-control" value="{{old('order_by', $slide->order_by)}}" id="inputOrderBy">
                </div>
                
                <div class="form-group">
                  <div class="input-file">
                    @if($slide->preview)
                    <div class="position-relative">
                      <a href="{{url('admin/mainslider/' . $slide->id . '/remove-image/preview')}}" class="btn btn-sm btn-danger position-absolute ml-2 mt-2"><i class="feather icon-trash"></i></a>
                      <img class="img-fluid d-block w-100 mb-3" src="{{url('uploads/mainslider/' . $slide->preview)}}">
                    </div>
                    @endif
                  </div>
                  <label for="inputPreview">@lang('admin.Preview')</label>
                  <input type="file" name="preview" class="form-control" id="inputPreview" accept="image/*" onchange="loadFile(event)">
                  @error('preview')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>

                <div class="form-group">
                  <div class="input-file">
                    @if($slide->picture)
                    <div class="position-relative">
                      <a href="{{url('admin/mainslider/' . $slide->id . '/remove-image/picture')}}" class="btn btn-sm btn-danger position-absolute ml-2 mt-2"><i class="feather icon-trash"></i></a>
                      <img class="img-fluid d-block w-100 mb-3" src="{{url('uploads/mainslider/' . $slide->picture)}}">
                    </div>
                    @endif
                  </div>
                  <label for="inputPicture">@lang('admin.Picture')</label>
                  <input type="file" name="picture" class="form-control" id="inputPicture" accept="image/*" onchange="loadFile(event)">
                  @error('picture')<div class="invalid-feedback d-block">{{$message}}</div>@enderror
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">@lang('admin.Update')</button>
      </form>
    </div>
  </div>
  <script>
    const loadFile = function(event) {
      let imageContainer = event.target.previousElementSibling.previousElementSibling
      if(imageContainer.classList.contains('input-file')) {
        let html = `<div class="position-relative">
          <a href="javascript:void(0)" onclick="removeFile('${event.target.id}')" title="{{__('admin.Delete')}}" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-danger position-absolute ml-2 mt-2"><i class="feather icon-trash"></i></a>
          <img class="img-fluid d-block w-100 mb-3" src="${URL.createObjectURL(event.target.files[0])}">
        </div>`
        imageContainer.innerHTML = html
      }
    }
    function removeFile(id) {
      URL.revokeObjectURL(document.getElementById(id).files[0]) // free memory
      document.getElementById(id).previousElementSibling.previousElementSibling.innerHTML = ''
      document.getElementById(id).value = ''
    }
  </script>
</x-admin-layout>
