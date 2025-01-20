<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/admin/types">{{__('admin.Types')}}</a></li>
            <li class="breadcrumb-item"><a href="#!">{{__('admin.EditType')}}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{url('admin/types/' . $type->id)}}" method="POST" id="typeForm" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-header">
            <h5>{{__('admin.EditType')}}</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName">{{__('admin.Name')}}</label>
                  <input type="text" name="name" value="{{$type->name}}" class="form-control" id="inputName" autofocus>
                  <div class="invalid-feedback d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputCode">{{__('admin.Code')}}</label>
                  <input type="text" name="code" value="{{$type->code}}" class="form-control" id="inputCode">
                  <div class="invalid-feedback d-block"></div>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group mt-4">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" @checked($type->status) class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">{{__('admin.ActiveStatus')}}</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
        <button type="button" data-url="{{ url('admin/types') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">{{__('admin.Cancel')}}</button>
      </form>
    </div>
  </div>
  @push('scripts')
  <script>

    const inputName = document.getElementById('inputName')
    const inputCode = document.getElementById('inputCode')
    const inputStatus = document.getElementById('inputStatus')

    const typeForm = document.getElementById('typeForm')
    typeForm.onsubmit = function(event) {
      event.preventDefault()
      const url = typeForm.getAttribute('action')
      const submitBtn = typeForm.querySelector('button[type="submit"]')
      submitBtn.setAttribute('disabled', true)
      fetch(url, {
        method: 'PUT',
        headers: {
          'Content-type': 'application/json; charset=UTF-8',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          name: inputName.value,
          code: inputCode.value,
          status: inputStatus.checked
        })
      }).then(response => response.json()).then(data => {
        submitBtn.removeAttribute('disabled')
        if(data.status == 'success') {
          window.location.href = '/admin/types'
        } else {
          let errors = data.errors
          console.log(errors)
          if(errors['name']) {
            inputName.nextElementSibling.textContent = errors['name']
          } else {
            inputName.nextElementSibling.textContent = ''
          }
          if(errors['code']) {
            inputCode.nextElementSibling.textContent = errors['code']
          } else {
            inputCode.nextElementSibling.textContent = ''
          }
        }
      }).catch(error => console.error(error.message))
    }
  </script>
  @endpush
</x-admin-layout>
