<x-admin-layout>
  <x-slot name="title">@lang('admin.Features')</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.Features')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body table-border-style">

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link text-uppercase active" data-toggle="tab" href="#featuresTab" role="tab" aria-controls="featuresTab" aria-selected="true">@lang('admin.Features')</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-uppercase" data-toggle="tab" href="#featureGroupsTab" role="tab" aria-controls="featureGroupsTab" aria-selected="false">@lang('admin.FeatureGroups')</a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane fade active show" id="featuresTab" role="tabpanel" aria-labelledby="featuresTab">

              <div class="card-header mb-3 px-0">
                <h5>@lang('admin.Features')</h5>
                @can('isAdmin')
                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newFeatureModal">
                  <i class="feather icon-plus"></i> @lang('admin.NewRecord')</button>
                @endcan
              </div>

              <div class="table-responsive">
                <table class="table table-striped" id="featuresTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>@lang('admin.Name')</th>
                      <th>@lang('admin.Slug')</th>
                      <th>@lang('admin.Unit')</th>
                      <th>@lang('admin.Group')</th>
                      <th>@lang('admin.OrderBy')</th>
                      <th>@lang('admin.Status')</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>

            </div>
            <div class="tab-pane fade" id="featureGroupsTab" role="tabpanel" aria-labelledby="featureGroupsTab">
              <div class="card-header mb-3 px-0">
                <h5>@lang('admin.FeatureGroups')</h5>
                {{-- @can('isAdmin')
                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newFeatureModal">
                  <i class="feather icon-plus"></i> @lang('admin.NewRecord')</button>
                @endcan --}}
              </div>

              <div class="table-responsive">
                <table class="table table-striped" id="featureGroupsTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>@lang('admin.Name')</th>
                      <th>@lang('admin.Slug')</th>
                      <th>@lang('admin.Language')</th>
                      <th>@lang('admin.Status')</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Общие</td>
                      <td>common</td>
                      <td>ru</td>
                      <td>1</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="newFeatureModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="newFeatureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newFeatureModalLabel">Создание характеристики товара</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form id="createFeatureForm" novalidate>
            <div class="form-group row">
              <label for="inputName" class="col-sm-3 col-form-label col-form-label-sm">{{__('admin.Name')}}</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputName" placeholder="Введите наименование характеристики">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputSlug" class="col-sm-3 col-form-label col-form-label-sm">{{__('admin.Slug')}}</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputSlug" placeholder="Системный идентификатор характеристики" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputUnit" class="col-sm-3 col-form-label col-form-label-sm">{{__('admin.Unit')}}</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputUnit" placeholder="Единица измерения">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputGroup" class="col-sm-3 col-form-label col-form-label-sm">{{__('admin.Group')}}</label>
              <div class="col-sm-9">
                <select type="text" class="form-control form-control-sm" id="inputGroup">
                  <option value="common" selected>Общие</option>
                  {{-- <option value="nutritional_value">Пищевая ценность</option> --}}
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputlang" class="col-sm-3 col-form-label col-form-label-sm">Язык</label>
              <div class="col-sm-9">
                <select id="inputlang" class="form-control form-control-sm">
                  <option value="ru" selected>Русский</option>
                  <option value="en">Английский</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputOrderBy" class="col-sm-3 col-form-label col-form-label-sm">@lang('admin.OrderBy')</label>
              <div class="col-sm-9">
                <input type="number" class="form-control form-control-sm" id="inputOrderBy" placeholder="Порядок вывода">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-3">Статус</div>
              <div class="col-sm-9">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="inputStatus">
                  <label class="form-check-label" for="inputStatus">Активный</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-sm btn-primary">Создать</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="editFeatureModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editFeatureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editFeatureModalLabel">Редактирование характеристики товара</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form onsubmit="updateData()" id="editFeatureForm" novalidate>
            <input type="hidden" id="inputEditId" value="">
            <div class="form-group row">
              <label for="inputEditName" class="col-sm-3 col-form-label col-form-label-sm">{{__('admin.Name')}}</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputEditName" placeholder="Введите название характеристики">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEditSlug" class="col-sm-3 col-form-label col-form-label-sm">{{__('admin.Slug')}}</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputEditSlug" placeholder="Системный идентификатор характеристики" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEditUnit" class="col-sm-3 col-form-label col-form-label-sm">{{__('admin.Unit')}}</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputEditUnit" placeholder="Единица измерения">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEditGroup" class="col-sm-3 col-form-label col-form-label-sm">{{__('admin.Group')}}</label>
              <div class="col-sm-9">
                <select type="text" class="form-control form-control-sm" id="inputEditGroup">
                  <option value="common" selected>Общие</option>
                  {{-- <option value="nutritional_value">Пищевая ценность</option> --}}
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEditLang" class="col-sm-3 col-form-label col-form-label-sm">Язык</label>
              <div class="col-sm-9">
                <select id="inputEditLang" class="form-control form-control-sm">
                  <option value="ru">Русский</option>
                  <option value="en">Английский</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEditOrderBy" class="col-sm-3 col-form-label col-form-label-sm">@lang('admin.OrderBy')</label>
              <div class="col-sm-9">
                <input type="number" class="form-control form-control-sm" id="inputEditOrderBy" placeholder="Порядок вывода">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-3">Статус</div>
              <div class="col-sm-9">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="inputEditStatus">
                  <label class="form-check-label" for="inputEditStatus">Активный</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

{{--   <div class="toast hide" role="alert" aria-live="assertive" data-delay="5000" aria-atomic="true">
    <div class="toast-header">
      <img src="images/favicon.ico" alt="" class="img-fluid m-r-5" style="width:20px;">
      <strong class="mr-auto">Системное уведомление</strong>
      <small class="text-muted">Только что</small>
      <button type="button" class="m-l-5 mb-1 mt-1 close" data-dismiss="toast" aria-label="Close">
        <span>&times;</span>
      </button>
    </div>
    <div class="toast-body"></div>
  </div> --}}

  @push('scripts')
  <script>
  loadData()
  
  function loadData() {
    fetch('/admin/features/load').then(res => res.json()).then(data => {
      const { features } = data
      let html = ''
      if(features.length > 0) {
        features.forEach(feature => {
          html += `<tr>
          <td>${feature.id}</td>
          <td>${feature.name}</td>
          <td>${feature.slug}</td>
          <td>${feature.unit}</td>
          <td>${feature.group}</td>
          <td>${feature.order_by}</td>
          <td>${feature.status}</td>
          <td class="text-right">
            <button class="btn btn-sm btn-info" onclick="getData(${feature.id})" data-id="" title="Edit"><i class="feather icon-edit"></i></button>
            <button onclick="deleteData(${feature.id})" class="btn btn-sm btn-danger" title="Delete"><i class="feather icon-trash"></i></button>
          </td>
        </tr>`
        })
      } else {
        html += '<tr><td colspan="6" class="text-danger text-center">Sorry! No records found</td></tr>'
      }
      document.querySelector('#featuresTable tbody').innerHTML = html
    }).catch(err => console.error(err.message))
  }

  const inputName = document.getElementById('inputName')
  const inputSlug = document.getElementById('inputSlug')
  const inputUnit = document.getElementById('inputUnit')
  const inputGroup = document.getElementById('inputGroup')
  const inputlang = document.getElementById('inputlang')
  const inputOrderBy = document.getElementById('inputOrderBy')
  const inputStatus = document.getElementById('inputStatus')

  /* inputName.onkeyup = function() {
    inputSlug.value = slugify(this.value, {lower: true})
  } */

  const createFeatureForm = document.getElementById('createFeatureForm')
  createFeatureForm.addEventListener('submit', function(event) {
    event.preventDefault()
    const name = inputName.value
    const slug = inputSlug.value
    const unit = inputUnit.value
    const group = inputGroup.value
    const lang = inputlang.value
    const orderBy = inputOrderBy.value
    const status = inputStatus.checked ? 1 : 0

    fetch('/admin/features/store', {
      method: 'POST',
      headers: {
        'Content-type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
      },
      body: 'name='+name+'&slug='+slug+'&unit='+unit+'&group='+group+'&lang='+lang+'&order_by='+orderBy+'&status='+status
    }).then(res => res.json()).then(data => {
      let message
      if(data.result == 1) {
        message = 'Характеристика товара успешно создана'
        document.getElementById('createFeatureForm').reset()
        $('#newFeatureModal').modal('hide')
        loadData()
      } else {
        message = 'Что-то пошло не так, попробуйте снова'
      }
      $('.toast .toast-body').text(message)
      $('.toast').toast('show')
    }).catch(err => console.error(err.message))

  })
  
  function getData(id) {
    fetch('/admin/features/load/' + id).then(res => res.json()).then(data => {
      if(data) {
        document.getElementById('inputEditId').value = data.id
        document.getElementById('inputEditName').value = data.name
        document.getElementById('inputEditSlug').value = data.slug
        document.getElementById('inputEditUnit').value = data.unit
        document.getElementById('inputEditGroup').value = data.group
        document.getElementById('inputEditLang').value = data.lang
        document.getElementById('inputEditOrderBy').value = data.order_by
        document.getElementById('inputEditStatus').checked = data.status
        $('#editFeatureModal').modal('show')
      }
    }).catch(err => console.error(err.message))
  }
  
  function updateData() {
    event.preventDefault()
    const id = document.getElementById('inputEditId').value
    const name = document.getElementById('inputEditName').value
    const slug = document.getElementById('inputEditSlug').value
    const unit = document.getElementById('inputEditUnit').value
    const group = document.getElementById('inputEditGroup').value
    const lang = document.getElementById('inputEditLang').value
    const orderBy = document.getElementById('inputEditOrderBy').value
    let status = document.getElementById('inputEditStatus').checked ? 1 : 0

    fetch('/admin/features/update/' + id, {
      method: 'PUT',
      headers: {
        'Content-type': 'application/x-www-form-urlencoded',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
      },
      body: 'name='+name+'&slug='+slug+'&unit='+unit+'&group='+group+'&lang='+lang+'&order_by='+orderBy+'&status='+status
    }).then(res => res.json()).then(data => {
      let message
      if(data.result == 1) {
        message = 'Характеристика товара успешно обновлена'
        document.getElementById('editFeatureForm').reset()
        $('#editFeatureModal').modal('hide')
        loadData()
      } else {
        message = 'Что-то пошло не так, попробуйте снова'
      }
      $('.toast .toast-body').text(message)
      $('.toast').toast('show')
    }).catch(err => console.error(err.message))
  }
  
  function deleteData(id) {
    if(confirm('Вы действительно хотите удалить эту характеристику?')) {

      fetch('/admin/features/destroy/' + id, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        }
      }).then(res => res.json()).then(data => {
        let message
        if(data.status == 'success') {
          message = 'Характеристика товара успешно удалена'
          loadData()
        } else {
          message = 'Что-то пошло не так, попробуйте снова'
        }
        $('.toast .toast-body').text(message)
        $('.toast').toast('show')
      }).catch(err => console.error(err.message))
    }
  }
  </script>
  @endpush
</x-admin-layout>
