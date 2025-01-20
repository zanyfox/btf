<x-admin-layout>
  <x-slot:title>@lang('admin.EditMerchant')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="align-items-center">
        <div class="page-header-title"></div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
          <li class="breadcrumb-item"><a href="{{url('admin/merchants')}}">{{__('admin.Merchants')}}</a></li>
          <li class="breadcrumb-item"><a href="#!">{{__('admin.EditMerchant')}}</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{url('admin/merchants/' . $merchant->id)}}" method="POST" id="merchantForm" novalidate>
        @csrf
        @method('PUT')
        <div class="card">
          <div class="card-header">
            <h5>{{__('admin.EditMerchant')}}</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName">{{__('admin.Name')}}</label>
                  <input type="text" name="name" value="{{$merchant->name}}" class="form-control" id="inputName" placeholder="{{__('admin.InsertName')}}" autofocus>
                  <div class="invalid-feedback d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputEmail">Email</label>
                  <input type="email" name="email" value="{{$merchant->email}}" class="form-control" id="inputEmail" placeholder="{{__('admin.InsertEmail')}}">
                  <div class="invalid-feedback d-block"></div>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group mt-4">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" @checked($merchant->status) class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">{{__('admin.ActiveStatus')}}</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
        <button type="button" data-url="{{ url('admin/merchants') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">{{__('admin.Cancel')}}</button>
      </form>
    </div>
  </div>
  @push('scripts')
  <script>
    
    const inputName = document.getElementById('inputName')
    const inputSlug = document.getElementById('inputSlug')
    const inputStatus = document.getElementById('inputStatus')

    inputName.addEventListener('keyup', function() {
      inputSlug.value = slugify(this.value)
    })

    const brandForm = document.getElementById('brandForm')
    brandForm.onsubmit = function(event) {
      event.preventDefault()
      const url = brandForm.getAttribute('action')
      const submitBtn = brandForm.querySelector('button[type="submit"]')
      submitBtn.setAttribute('disabled', true)
      fetch(url, {
        method: 'PUT',
        headers: {
          'Content-type': 'application/json; charset=UTF-8',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          name: inputName.value,
          slug: inputSlug.value,
          status: inputStatus.checked
        })
      }).then(response => response.json()).then(data => {
        submitBtn.removeAttribute('disabled')
        if(data.status == 'success') {
          window.location.href = '/admin/brands'
        } else {
          let errors = data.errors
          console.log(errors)
          if(errors['name']) {
            inputName.nextElementSibling.textContent = errors['name']
          } else {
            inputName.nextElementSibling.textContent = ''
          }
          if(errors['slug']) {
            inputSlug.nextElementSibling.textContent = errors['slug']
          } else {
            inputSlug.nextElementSibling.textContent = ''
          }
        }
      }).catch(error => console.error(error.message))

    }
  </script>
  @endpush
</x-admin-layout>
