<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">{{ __('admin.Settings') }}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header">
          <h5>{{ __('admin.Settings') }}</h5>
          <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#newSettingModal">
            <i class="feather icon-plus"></i> {{__('admin.NewRecord')}}
          </button>
        </div>
        <div class="card-body table-border-style">
          <div class="table-responsive">
            <table class="table table-striped" id="settingsTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{__('admin.Name')}}</th>
                  <th>{{__('admin.Key')}}</th>
                  <th>{{__('admin.Value')}}</th>
                  <th>{{__('admin.Language')}}</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="newSettingModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="newSettingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newSettingModalLabel">Создание настройки</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form onsubmit="createSetting()" id="createSettingForm" novalidate>
            <div class="form-group row">
              <label for="inputName" class="col-sm-3 col-form-label col-form-label-sm">Название</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputName" placeholder="Введите название настройки">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputKey" class="col-sm-3 col-form-label col-form-label-sm">Ключ</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputKey" placeholder="Системный идентификатор настройки" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputValue" class="col-sm-3 col-form-label col-form-label-sm">Значение</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputValue" placeholder="Введите значение настройки" required>
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

  <div id="editSettingModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editSettingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editSettingModalLabel">Редактирование настройки</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form onsubmit="updateSetting()" id="editSettingForm" novalidate>
            <input type="hidden" id="inputEditId" value="">
            <div class="form-group row">
              <label for="inputEditName" class="col-sm-3 col-form-label col-form-label-sm">Название</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputEditName" placeholder="Введите название настройки">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEditKey" class="col-sm-3 col-form-label col-form-label-sm">Ключ</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputEditKey" placeholder="Системный идентификатор настройки" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEditValue" class="col-sm-3 col-form-label col-form-label-sm">Значение</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="inputEditValue" placeholder="Введите значение настройки" required>
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

  @push('scripts')
  <script>
  if(document.querySelector('#settingsTable')) {
    loadSettings()
  }
  
  function loadSettings() {
    const xhr = new XMLHttpRequest()
    xhr.open('GET','/admin/settings/load',true)
    xhr.send()
    xhr.onreadystatechange = function() {
      if(xhr.readyState==4 && xhr.status==200) {
        const settings = JSON.parse(xhr.responseText)
        let html = ''
        if(settings.length > 0) {
          settings.forEach(setting => {
            html += `<tr>
            <td>${setting.id}</td>
            <td>${setting?.name}</td>
            <td>${setting?.key}</td>
            <td>${setting.value}</td>
            <td>${setting.lang}</td>
            <td class="text-right">
              <button onclick="getSetting(${setting.id})" class="btn btn-sm btn-info" title="Edit"><i class="feather icon-edit"></i></button>
              <button onclick="deleteSetting(${setting.id})" class="btn btn-sm btn-danger" title="Delete"><i class="feather icon-trash"></i></button>
            </td>
          </tr>`
          })
        } else {
          html += '<tr><td colspan="6" class="text-danger text-center">Sorry! No settings found</td></tr>'
        }
        document.querySelector('#settingsTable tbody').innerHTML = html
      }
    }
  }
  
  function createSetting() {
    event.preventDefault()
    const params = {
      name: document.getElementById('inputName').value,
      key: document.getElementById('inputKey').value, 
      value: document.getElementById('inputValue').value, 
      lang: document.getElementById('inputlang').value.value, 
      status: document.getElementById('inputStatus').value == 'on' ? true : false
    }

    const xhr = new XMLHttpRequest()
    xhr.open('POST', '/admin/settings/store', true)
    xhr.setRequestHeader('Content-type','application/json')
    xhr.setRequestHeader('X-CSRF-TOKEN','{{ csrf_token() }}')
    xhr.send(JSON.stringify(params))
    xhr.onreadystatechange = function() {
      if(xhr.readyState==4 && xhr.status==200) {
        let response = xhr.responseText
        let message
        if(response == 1) {
          message = 'Record Created Successfully'
          document.getElementById('createSettingForm').reset()
          $('#newSettingModal').modal('hide')
          loadSettings()
        } else if(response == 2) {
          message = 'Unable To Create A Record'
        } else if(response == 3) {
          message = 'Unable To Receive The Data'
        } else {
          message = 'SomethingWentWrong'
        }
        $('.toast .toast-body').text(message)
        $('.toast').toast('show')

      }
    }
  }
  
  function getSetting(id) {
    const xhr = new XMLHttpRequest()
    xhr.open('GET','/admin/settings/show/' + id, true)
    xhr.send()
    xhr.onreadystatechange = function() {
      if(xhr.readyState==4 && xhr.status==200) {
        const setting = JSON.parse(xhr.responseText)
        if(setting) {
          document.getElementById('inputEditId').value = setting.id
          document.getElementById('inputEditName').value = setting.name
          document.getElementById('inputEditKey').value = setting.key
          document.getElementById('inputEditValue').value = setting.value
          document.getElementById('inputEditLang').value = setting.lang
          document.getElementById('inputEditStatus').checked = setting.status
          $('#editSettingModal').modal('show')
        }
      }
    }
  }
  
  function updateSetting() {
    event.preventDefault()

    const id = document.getElementById('inputEditId').value

    const params = {
      id: id,
      name: document.getElementById('inputEditName').value,
      key: document.getElementById('inputEditKey').value, 
      value: document.getElementById('inputEditValue').value, 
      lang: document.getElementById('inputEditLang').value, 
      status: document.getElementById('inputEditStatus').value == 'on' ? true : false
    }
  
    // Send data to server
    const xhr = new XMLHttpRequest()
    xhr.open('POST','/admin/settings/update/' + id,true)
    xhr.setRequestHeader('Content-type','application/json')
    xhr.setRequestHeader('X-CSRF-TOKEN','{{ csrf_token() }}')
    xhr.send(JSON.stringify(params))
    xhr.onreadystatechange = function() {
      if(xhr.readyState==4 && xhr.status==200) {
        let response = xhr.responseText
        let message
        if(response == 1) {
          message = 'Account updated successfully'
          document.getElementById('editSettingForm').reset()
          $('#editSettingModal').modal('hide')
          loadSettings()
        } else if(response == 2) {
          message = 'Sorry! Unable to update an account'
        } else if(response == 3) {
          message = 'Sorry! Unable to receive the data'
        } else if(response == 4) {
          message = 'Sorry! Unable to receive the data'
        } else {
          message = 'Something went wrong. Try again'
        }
        $('.toast .toast-body').text(message)
        $('.toast').toast('show')
      }
    }
  }
  
  function deleteSetting(id) {
    if(confirm('Do you want to delete this record?')) {
      const xhr = new XMLHttpRequest()
      xhr.open('GET','/admin/settings/delete/' + id,true)
      xhr.send()
      xhr.onreadystatechange = function() {
        if(xhr.readyState==4 && xhr.status==200) {
          const response = xhr.responseText
          let message
          if(response == true) {
            message = 'Setting deleted successfully'
            loadSettings()
          } else if(response == 2) {
            message = 'Sorry! Unable to delete an setting'
          } else {
            message = 'Invalid request sent to server'
          }
          $('.toast .toast-body').text(message)
          $('.toast').toast('show')
        }
      }
    }
  }
  </script>
  @endpush
</x-admin-layout>
