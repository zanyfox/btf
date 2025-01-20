<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/services') }}">@lang('admin.Services')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.EditRecord')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{url('admin/services/' . $service->id)}}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.EditRecord')</h5>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active text-uppercase" data-toggle="tab" href="#basicTab" role="tab" aria-controls="basicTab" aria-selected="true">@lang('admin.Basic')</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-uppercase" data-toggle="tab" href="#customTab" role="tab" aria-controls="customTab" aria-selected="false">@lang('admin.Custom')</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-uppercase" data-toggle="tab" href="#seoTab" role="tab" aria-controls="seoTab" aria-selected="false">SEO</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="basicTab" role="tabpanel" aria-labelledby="basicTab">
                <div class="row">
                  <div class="col col-8">
                    <div class="form-group">
                      <label for="inputName">@lang('admin.Name')</label>
                      <input name="name" value="{{old('name') ?? $service->name}}" class="form-control" id="inputName" placeholder="@lang('admin.InsertName')" autofocus>
                      @if($errors->has('name'))
                      <div class="invalid-feedback d-block">{{$errors->first('name')}}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputSlug">@lang('admin.Slug')</label>
                      <input name="slug" value="{{old('slug') ?? $service->slug}}" class="form-control" id="inputSlug" placeholder="@lang('admin.InsertSlug')">
                      @if($errors->has('slug'))
                      <div class="invalid-feedback d-block">{{$errors->first('slug')}}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputTagline">@lang('admin.Tagline')</label>
                      <input name="tagline" value="{{old('tagline') ?? $service->tagline}}" class="form-control" id="inputTagline" placeholder="@lang('admin.InsertTagline')">
                      @if($errors->has('tagline'))
                      <div class="invalid-feedback d-block">{{$errors->first('tagline')}}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputBody">@lang('admin.Body')</label>
                      <textarea id="inputBody" name="body" class="form-control hasEditor">{{old('body') ?? $service->body}}</textarea>
                    </div>
                  </div>
                  <div class="col col-4">
                    <div class="form-group">
                      <label for="inputParent">@lang('admin.Parent')</label>
                      <select name="parent_id" class="form-control" id="inputParent">
                        <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                        @foreach($services as $s)
                        <option value="{{$s->id}}" @selected($s->id == $service->parent_id) >{{$s->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" @checked(old('status', $service->status)) class="custom-control-input" id="customCheckStatus">
                        <label class="custom-control-label" for="customCheckStatus">@lang('admin.ActiveStatus')</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputLanguage">@lang('admin.Language')</label>
                      <select name="lang" class="form-control" id="inputLanguage">
                        <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                        @foreach (Lang::cases() as $lang)
                        <option value="{{$lang->value}}" @selected(old('lang') ?? $service->lang == $lang->value)>{{$lang->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="inputPrice">@lang('admin.Price')</label>
                      <input type="number" name="price" value="{{ old('price') ?? $service->price }}" class="form-control" id="inputPrice">
                    </div>

                    <div class="form-group">
                      <label for="inputOrderBy">@lang('admin.OrderBy')</label>
                      <input type="number" name="order_by" step="1" min="1" value="{{old('order_by') ?? $service->order_by}}" class="form-control" id="inputOrderBy">
                    </div>

                    <div class="fileUpload">
                      <h6>@lang('admin.Cover')</h6>
                      @if($service->cover)
                      <img class="img-fluid d-block w-100 mb-3" src="{{Storage::url($service->cover)}}">
                      @endif
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">@lang('admin.Upload')</span>
                        </div>
                        <div class="custom-file">
                          <input type="file" name="cover" class="custom-file-input" id="inputGroupFileCover">
                          <label class="custom-file-label" for="inputGroupFileCover">@lang('admin.ChooseFile')</label>
                        </div>
                      </div>
                      @error('cover')
                      <div class="invalid-feedback d-block">{{$message}}</div>
                      @enderror
                    </div>
                    <div class="fileUpload">
                      <h6>@lang('admin.Picture')</h6>
                      @if($service->picture)
                      <img class="img-fluid d-block w-100 mb-3" src="{{Storage::url($service->picture)}}">
                      @endif
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">@lang('admin.Upload')</span>
                        </div>
                        <div class="custom-file">
                          <input type="file" name="picture" class="custom-file-input" id="inputGroupFilePicture">
                          <label class="custom-file-label" for="inputGroupFilePicture">@lang('admin.ChooseFile')</label>
                        </div>
                      </div>
                      @error('picture')
                      <div class="invalid-feedback d-block">{{$message}}</div>
                      @enderror
                    </div>

                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="customTab" role="tabpanel" aria-labelledby="customTab">
                <div class="row">
                  <div class="col col-8" id="wrapperCustom">
                    @php
                    $custom = [];
                    if( !empty($service->custom) ) {
                      $custom = json_decode($service->custom);
                    }
                    $index = 0;
                    @endphp
                    @foreach($custom as $item)
                    <div class="custom border border-primary px-3 pt-2 mb-3">
                      <div class="row">
                        <div class="form-group col col-6">
                          <label for="customTitle{{$index}}">Заголовок</label>
                          <input type="text" name="custom[{{$index}}][title]" id="customTitle{{$index}}" value="{{ $item->title }}" placeholder="Введите заголовок" class="form-control">
                        </div>
                        <div class="form-group col col-6">
                          <label for="customAlias{{$index}}">Алиас</label>
                          <input type="text" name="custom[{{$index}}][alias]" id="customAlias{{$index}}" value="{{ $item->alias }}" class="form-control">
                        </div>
                        <div class="form-group col col-12">
                          <label for="customBody{{$index}}">Текст</label>
                          <textarea name="custom[{{$index}}][body]" id="customBody{{$index}}" class="form-control hasEditor">{{ $item->body }}</textarea>
                        </div>
                        <div class="form-group col col-12">
                          <button type="button" onclick="this.closest('.custom').remove()" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                        </div>
                      </div>
                    </div>
                    @php
                    $index++;
                    @endphp
                    @endforeach
                  </div>
                  <div class="col col-4">
                    <button type="button" class="btn btn-sm btn-warning" id="btnCreateCustom"><i class="feather icon-plus"></i></button>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="seoTab" role="tabpanel" aria-labelledby="seoTab">
                <div class="row">
                  <div class="col col-8">
                    <div class="form-group">
                      <label for="inputMetatitle">@lang('admin.Metatitle')</label>
                      <input type="text" name="metatitle" class="form-control" value="{{old('metatitle') ?? $service->metatitle}}" id="inputMetatitle" placeholder="@lang('admin.InsertMetatitle')">
                      @if($errors->has('metatitle'))
                      <div class="invalid-feedback d-block">{{$errors->first('metatitle')}}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputKeywords">{{__('admin.Keywords')}}</label>
                      <input type="text" name="keywords" class="form-control" value="{{old('keywords') ?? $service->keywords}}" id="inputKeywords" placeholder="@lang('admin.InsertKeywords')">
                      @if($errors->has('keywords'))
                      <div class="invalid-feedback d-block">{{$errors->first('keywords')}}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputDescription">@lang('admin.Description')</label>
                      <input type="text" name="description" class="form-control" value="{{old('description') ?? $service->description}}" id="inputDescription" placeholder="@lang('admin.InsertDescription')">
                      @if($errors->has('description'))
                      <div class="invalid-feedback d-block">{{$errors->first('description')}}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col col-4">
                    <div class="form-group">
                      <label for="inputRobots">@lang('admin.Robots')</label>
                      <select name="robots" class="form-control" id="inputRobots">
                        <option value="" disabled selected>@lang('admin.ChooseOption')</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">@lang('admin.Update')</button>
        <button type="button" data-url="{{ url('admin/services') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">@lang('admin.Cancel')</button>
      </form>
    </div>
  </div>
  <script>
    let wrapperCustom = document.getElementById('wrapperCustom')
    const btnCreateCustom = document.getElementById('btnCreateCustom')
    btnCreateCustom.onclick = function() {
      let customs = wrapperCustom.querySelectorAll('.custom')
      let index = customs.length
      let html = `<div class="custom border border-primary px-3 pt-2 mb-3">
                  <div class="row">
                    <div class="form-group col col-6">
                      <label for="customTitle${index}">Заголовок</label>
                      <input type="text" name="custom[${index}][title]" id="customTitle${index}" class="form-control" placeholder="Введите заголовок">
                    </div>
                    <div class="form-group col col-6">
                      <label for="customAlias${index}">Алиас</label>
                      <input type="text" name="custom[${index}][alias]" id="customAlias${index}" class="form-control">
                    </div>
                    <div class="form-group col col-12">
                      <label for="customBody${index}">Текст</label>
                      <textarea name="custom[${index}][body]" id="customBody${index}" class="form-control hasEditor"></textarea>
                    </div>
                    <div class="form-group col col-12">
                      <button type="button" onclick="this.closest('.custom').remove()" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i></button>
                    </div>
                  </div>
              </div>`
      wrapperCustom.insertAdjacentHTML('beforeend', html)

      const newHasEditor = document.querySelector('#customBody' + index + '.hasEditor')
      ClassicEditor.create(newHasEditor, {
        //plugins: [SourceEditing],
        //toolbar:  'sourceEditing']
      }).catch( error => console.error(error))
    }
  </script>
</x-admin-layout>
