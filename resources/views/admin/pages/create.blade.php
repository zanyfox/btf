<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/admin/pages">{{__('admin.Pages')}}</a></li>
            <li class="breadcrumb-item"><a href="#!">{{__('admin.CreatePage')}}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{url('admin/pages')}}" method="POST" novalidate>
        @csrf
        <div class="card">
          <div class="card-header">
            <h5>{{__('admin.CreatePage')}}</h5>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active text-uppercase" data-toggle="tab" href="#basicTab" role="tab" aria-controls="basicTab" aria-selected="true">{{__('admin.Basic')}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-uppercase" data-toggle="tab" href="#customTab" role="tab" aria-controls="customTab" aria-selected="false">{{__('admin.Custom')}}</a>
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
                      <label for="inputTitle">{{__('admin.Title')}}</label>
                      <input type="text" name="title" value="{{old('title')}}" class="form-control" id="inputTitle" placeholder="{{__('admin.InsertTitle')}}" autofocus>
                      @if($errors->has('title'))
                      <div class="invalid-feedback d-block">{{$errors->first('title')}}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputSlug">{{__('admin.Slug')}}</label>
                      <input type="text" name="slug" value="{{old('slug')}}" class="form-control" id="inputSlug" placeholder="{{__('admin.InsertSlug')}}">
                      @if($errors->has('slug'))
                      <div class="invalid-feedback d-block">{{$errors->first('slug')}}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputSubtitle">{{__('admin.Subtitle')}}</label>
                      <input type="text" name="subtitle" value="{{old('subtitle')}}" class="form-control" id="inputSubtitle" placeholder="{{__('admin.InsertSubtitle')}}">
                    </div>
                    <div class="form-group">
                      <label for="inputText">{{__('admin.Text')}}</label>
                      <textarea id="inputText" name="text" class="form-control hasEditor">{{old('text')}}</textarea>
                    </div>
                  </div>
                  <div class="col col-4">
                    <div class="form-group">
                      <label for="inputParent">{{__('admin.SelectParent')}}</label>
                      <select name="parent_id" class="form-control" id="inputParent">
                        <option value="" disabled selected>{{__('admin.ChooseParent')}}</option>
                        @foreach($pages as $p)
                        <option value="{{$p->id}}">{{$p->title}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" @checked(old('status')) class="custom-control-input" id="customCheckStatus">
                        <label class="custom-control-label" for="customCheckStatus">{{__('admin.ActiveStatus')}}</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputLanguage">{{__('admin.SelectLanguage')}}</label>
                      <select name="lang" class="form-control" id="inputLanguage">
                        <option value="" disabled selected>{{__('admin.ChooseLanguage')}}</option>
                        @foreach (Lang::cases() as $lang)
                        <option value="{{$lang->value}}" @selected(old('lang'))>{{$lang->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="inputSort">{{__('admin.Sort')}}</label>
                      <input type="number" name="sort" step="1" min="1" value="{{old('sort') ?? 1}}" class="form-control" id="inputSort">
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="customTab" role="tabpanel" aria-labelledby="customTab">
                <div class="row">
                  <div class="col col-8" id="wrapperCustom"></div>
                  <div class="col col-4">
                    <button type="button" class="btn btn-sm btn-warning" id="btnCreateCustom"><i class="feather icon-plus"></i></button>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="seoTab" role="tabpanel" aria-labelledby="seoTab">
                <div class="row">
                  <div class="col col-8">
                    <div class="form-group">
                      <label for="inputMetatitle">{{__('admin.Metatitle')}}</label>
                      <input type="text" name="metatitle" class="form-control" value="{{old('metatitle')}}" id="inputMetatitle" placeholder="{{__('admin.InsertMetatitle')}}">
                      @if($errors->has('metatitle'))
                      <div class="invalid-feedback d-block">
                        {{$errors->first('metatitle')}}
                      </div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputKeywords">{{__('admin.Keywords')}}</label>
                      <input type="text" name="keywords" class="form-control" value="{{old('keywords')}}" id="inputKeywords" placeholder="{{__('admin.InsertKeywords')}}">
                      @if($errors->has('keywords'))
                      <div class="invalid-feedback d-block">
                        {{$errors->first('keywords')}}
                      </div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="inputDescription">{{__('admin.Description')}}</label>
                      <input type="text" name="description" class="form-control" value="{{old('description')}}" id="inputDescription" placeholder="{{__('admin.InsertDescription')}}">
                      @if($errors->has('description'))
                      <div class="invalid-feedback d-block">
                        {{$errors->first('description')}}
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="col col-4">
                    <div class="form-group">
                      <label for="inputParent">{{__('admin.SelectVariant')}}</label>
                      <select name="parent_id" class="form-control" id="inputRobots">
                        <option value="" disabled selected>{{__('admin.ChooseVariant')}}</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">{{__('admin.Create')}}</button>
        <button type="button" data-url="{{ url('admin/pages') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">{{__('admin.Cancel')}}</button>
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
      /* ClassicEditor.create(newHasEditor, {
        //plugins: [SourceEditing],
        //toolbar:  'sourceEditing']
      }).catch( error => console.error(error)) */
    }
  </script>
</x-admin-layout>
