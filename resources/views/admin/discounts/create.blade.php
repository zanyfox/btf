<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/admin/discounts">{{__('admin.Discounts')}}</a></li>
            <li class="breadcrumb-item"><a href="#!">{{__('admin.CreateDiscount')}}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{url('admin/discounts')}}" method="POST" id="discountForm" novalidate>
        @csrf
        <div class="card">
          <div class="card-header">
            <h5>{{__('admin.CreateDiscount')}}</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col col-8">
                <div class="form-group">
                  <label for="inputCode">{{__('admin.CouponCode')}}</label>
                  <input type="text" name="code" class="form-control" id="inputCode" autocomplete="code" autofocus placeholder="{{__('admin.CouponCode')}}">
                  <div class="d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputName">{{__('admin.CouponName')}}</label>
                  <input type="text" name="name" class="form-control" id="inputName" placeholder="{{__('admin.CouponName')}}">
                </div>
                <div class="form-group">
                  <label for="inputDescription">{{__('admin.Description')}}</label>
                  <textarea id="inputDescription" name="description" class="form-control"></textarea>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="inputStartsAt">{{__('admin.StartsAt')}}</label>
                    <input type="date" name="starts_at" class="form-control" id="inputStartsAt" autocomplete="off">
                    <div class="d-block"></div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputExpiresAt">{{__('admin.ExpiresAt')}}</label>
                    <input type="date" name="expires_at" class="form-control" id="inputExpiresAt" autocomplete="off">
                    <div class="d-block"></div>
                  </div>
                </div>
              </div>
              <div class="col col-4">
                <div class="form-group mt-4">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="status" @checked(true) class="custom-control-input" id="inputStatus">
                    <label class="custom-control-label" for="inputStatus">{{__('admin.ActiveStatus')}}</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputType">{{__('admin.Type')}}</label>
                  <select name="type" class="form-control" id="inputType">
                    <option value="fixed" selected>{{__('admin.Fixed')}}</option>
                    <option value="percent">{{__('admin.Percent')}}</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputMaxUses">{{__('admin.MaxUses')}}</label>
                  <input type="number" name="max_uses" class="form-control" id="inputMaxUses">
                </div>
                <div class="form-group">
                  <label for="inputMaxUsesUser">{{__('admin.MaxUsesUser')}}</label>
                  <input type="number" name="max_uses_user" class="form-control" id="inputMaxUsesUser">
                </div>
                <div class="form-group">
                  <label for="inputDiscountAmount">{{__('admin.DiscountAmount')}}</label>
                  <input type="number" name="discount_amount" class="form-control" id="inputDiscountAmount">
                  <div class="d-block"></div>
                </div>
                <div class="form-group">
                  <label for="inputMinAmount">{{__('admin.MinAmount')}}</label>
                  <input type="number" name="min_amount" class="form-control" id="inputMinAmount">
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">{{__('admin.Create')}}</button>
        <button type="button" data-url="{{ url('admin/discounts') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">{{__('admin.Cancel')}}</button>
      </form>
    </div>
  </div>
  @push('scripts')
  <script>

    const inputCode = document.querySelector('#inputCode')
    const inputDiscountAmount = document.querySelector('#inputDiscountAmount')
    const inputStartsAt = document.querySelector('#inputStartsAt')
    const inputExpiresAt = document.querySelector('#inputExpiresAt')

    const discountForm = document.getElementById('discountForm')
    const submitBtn = discountForm.querySelector('button[type="submit"]')

    discountForm.addEventListener('submit', function(event) {
      event.preventDefault()
      submitBtn.setAttribute('disabled', true)

      let values = Array.from(new FormData(discountForm), function(e) {
        return e.map(encodeURIComponent).join('=');
      }).join('&')

      console.log(values)

      fetch('/admin/discounts', {
        method: 'POST',
        headers: {
          'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: values
      }).then(response => response.json()).then(data => {
        submitBtn.removeAttribute('disabled')
        if(data.status == 'success') {
          window.location.href = '/admin/discounts'
        } else {
          let {errors} = data
          console.log(errors)

          if(errors['code']) {
            inputCode.classList.add('is-invalid')
            inputCode.nextElementSibling.classList.add('invalid-feedback')
            inputCode.nextElementSibling.textContent = errors['code']
          } else {
            inputCode.classList.remove('is-invalid')
            inputCode.nextElementSibling.classList.remove('invalid-feedback')
            inputCode.nextElementSibling.textContent = ''
          }

          if(errors['discount_amount']) {
            inputDiscountAmount.classList.add('is-invalid')
            inputDiscountAmount.nextElementSibling.classList.add('invalid-feedback')
            inputType.nextElementSibling.textContent = errors['discount_amount']
          } else {
            inputDiscountAmount.classList.remove('is-invalid')
            inputDiscountAmount.nextElementSibling.classList.remove('invalid-feedback')
            inputDiscountAmount.nextElementSibling.textContent = ''
          }

          if(errors['starts_at']) {
            inputStartsAt.classList.add('is-invalid')
            inputStartsAt.nextElementSibling.classList.add('invalid-feedback')
            inputStartsAt.nextElementSibling.textContent = errors['starts_at']
          } else {
            inputStartsAt.classList.remove('is-invalid')
            inputStartsAt.nextElementSibling.classList.remove('invalid-feedback')
            inputStartsAt.nextElementSibling.textContent = ''
          }

          if(errors['expires_at']) {
            inputExpiresAt.classList.add('is-invalid')
            inputExpiresAt.nextElementSibling.classList.add('invalid-feedback')
            inputExpiresAt.nextElementSibling.textContent = errors['expires_at']
          } else {
            inputExpiresAt.classList.remove('is-invalid')
            inputExpiresAt.nextElementSibling.classList.remove('invalid-feedback')
            inputExpiresAt.nextElementSibling.textContent = ''
          }

        }
      }).catch(error => console.error(error.message))
    })
  </script>
  @endpush
</x-admin-layout>