<x-admin-layout>
  <x-slot name="title">@lang('admin.EditDeliveryMethod')</x-slot>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/delivery-methods') }}">@lang('admin.DeliveryMethods')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.EditDeliveryMethod')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{url('admin/delivery-methods/' . $deliveryMethod->id)}}" method="POST" id="DeliveryMethodForm" novalidate>
        @csrf
        <div class="card">
          <div class="card-header">
            <h5>@lang('admin.EditDeliveryMethod')</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputName">@lang('admin.Name')</label>
                  <input type="text" name="name" value="{{$deliveryMethod->name}}" class="form-control" id="inputName">
                  <div class="d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputCode">@lang('admin.Code')</label>
                  <input type="text" name="code" value="{{$deliveryMethod->code}}" class="form-control" id="inputCode">
                  <div class="d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputAmount">@lang('admin.Amount')</label>
                  <input type="number" name="amount" value="{{$deliveryMethod->amount}}" class="form-control" id="inputAmount">
                  <div class="d-block"></div>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group">
                  <label for="inputExternalId">@lang('admin.ExternalId')</label>
                  <input type="text" name="external_id" value="{{$deliveryMethod->external_id}}" class="form-control" id="inputExternalId" />
                  <div class="d-block"></div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" @checked($deliveryMethod->status) class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">@lang('admin.ActiveStatus')</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputSort">@lang('admin.Sort')</label>
                  <input type="number" name="sort" value="{{$deliveryMethod->sort}}" class="form-control" id="inputSort">
                  <div class="d-block"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">@lang('admin.Update')</button>
        <button type="button" data-url="{{ url('admin/delivery-methods') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">@lang('admin.Cancel')</button>
      </form>
    </div>
  </div>
  @push('scripts')
  <script>

    const inputName = document.getElementById('inputName')
    const inputCode = document.getElementById('inputCode')
    const inputExternalId = document.getElementById('inputExternalId')
    const inputAmount = document.getElementById('inputAmount')
    const inputStatus = document.getElementById('inputStatus')
    const inputSort = document.getElementById('inputSort')

    const DeliveryMethodForm = document.getElementById('DeliveryMethodForm')
    const submitBtn = DeliveryMethodForm.querySelector('button[type="submit"]')
    DeliveryMethodForm.onsubmit = function(event) {
      event.preventDefault()

      let values = {
        name: inputName.value,
        code: inputCode.value,
        external_id: inputExternalId.value,
        amount: inputAmount.value,
        status: inputStatus.checked,
        sort: inputSort.value,
      }

      submitBtn.setAttribute('disabled', true)
      fetch('/admin/delivery-methods/{{$deliveryMethod->id}}', {
        method: 'PUT',
        headers: {
          'Content-type': 'application/json; charset=UTF-8',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(values)
      }).then(response => response.json()).then(data => {
        submitBtn.removeAttribute('disabled')
        if(data.status == 'success') {
          window.location.href = '/admin/delivery-methods'
        } else {
          let errors = data.errors
          console.log(data)

          if(errors['name']) {
            inputName.classList.add('is-invalid')
            inputName.nextElementSibling.classList.add('invalid-feedback')
            inputName.nextElementSibling.textContent = errors['name']
          } else {
            inputName.classList.remove('is-invalid')
            inputName.nextElementSibling.classList.remove('invalid-feedback')
            inputName.nextElementSibling.textContent = ''
          }

          if(errors['code']) {
            inputCode.classList.add('is-invalid')
            inputCode.nextElementSibling.classList.add('invalid-feedback')
            inputCode.nextElementSibling.textContent = errors['code']
          } else {
            inputCode.classList.remove('is-invalid')
            inputCode.nextElementSibling.classList.remove('invalid-feedback')
            inputCode.nextElementSibling.textContent = ''
          }

          if(errors['amount']) {
            inputAmount.classList.add('is-invalid')
            inputAmount.nextElementSibling.classList.add('invalid-feedback')
            inputAmount.nextElementSibling.textContent = errors['amount']
          } else {
            inputAmount.classList.remove('is-invalid')
            inputAmount.nextElementSibling.classList.remove('invalid-feedback')
            inputAmount.nextElementSibling.textContent = ''
          }

        }
      }).catch(error => console.error(error.message))
    }
  </script>
  @endpush
</x-admin-layout>