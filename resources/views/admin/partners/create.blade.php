<x-admin-layout>
  <x-slot:title>@lang('admin.CreatePartner')</x-slot:title>
  <div class="page-header">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
      <li class="breadcrumb-item"><a href="{{url('admin/partners')}}">@lang('admin.Partners')</a></li>
      <li class="breadcrumb-item"><a href="#!">@lang('admin.CreatePartner')</a></li>
    </ul>
  </div>
  <form action="{{url('admin/partners')}}" method="POST" id="partnerForm" novalidate>
    @csrf
    <div class="card">
      <div class="card-header">
        <h5>@lang('admin.CreatePartner')</h5>
      </div>
      <div class="card-body">

        <div class="threebody-loader">
          <div><i class="threebody-spinner"></i></div>
        </div>

        <div class="row">
          <div class="col col-md-8">
            <div class="form-group">
              <label for="inputCompany">@lang('admin.Company')</label>
              <input type="text" name="company" class="form-control" id="inputCompany" placeholder="@lang('admin.Company')" autofocus>
              <div class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="inputName">@lang('admin.Name')</label>
              <input type="text" name="name" class="form-control" id="inputName" placeholder="@lang('admin.InsertName')">
              <div class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="inputSurname">@lang('admin.Surname')</label>
              <input type="text" name="surname" class="form-control" id="inputSurname" placeholder="@lang('admin.Surname')">
              <div class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="inputEmail">Email</label>
              <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
              <div class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="inputPhone">@lang('admin.Phone')</label>
              <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="@lang('admin.Phone')">
              <div class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="inputCity">@lang('admin.City')</label>
              <input type="text" name="city" class="form-control" id="inputCity" placeholder="@lang('admin.City')">
              <div class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="inputAddress">@lang('admin.Address')</label>
              <input type="text" name="address" class="form-control" id="inputAddress" placeholder="@lang('admin.Address')">
              <div class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="inputCoordinates">@lang('admin.Coordinates')</label>
              <input type="text" name="coordinates" class="form-control" id="inputCoordinates" placeholder="@lang('admin.Coordinates')">
              <div class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="inputSite">@lang('admin.Site')</label>
              <input type="text" name="site" class="form-control" id="inputSite" placeholder="@lang('admin.Site')">
              <div class="invalid-feedback d-block"></div>
            </div>
            <div class="form-group">
              <label for="inputSchedule">@lang('admin.Schedule')</label>
              <input type="text" name="schedule" class="form-control" id="inputSchedule" placeholder="@lang('admin.Schedule')">
              <div class="invalid-feedback d-block"></div>
            </div>
          </div>
          <div class="col col-md-4">
            <div class="form-group">
              <label for="inputOrderBy">@lang('admin.OrderBy')</label>
              <input type="number" name="order_by" min="1" value="{{ old('order_by') ?? $max }}" class="form-control" id="inputOrderBy">
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="status" checked class="custom-control-input" id="inputStatus">
                <label class="custom-control-label" for="inputStatus">@lang('admin.ActiveStatus')</label>
              </div>
            </div>
            <div class="form-group">
              <div class="upload-preview"></div>
              <label for="uploadFile">@lang('admin.Picture')</label>
              <div id="uploadFile" class="dropzone dz-clickable border-dropzone border-primary"></div>
              <input type="hidden" name="picture" id="inputPicture" value="">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="fixed-bottom pt-3 pb-3 w-100 bg-light" style="padding-left: 260px; z-index: 999; box-shadow: -1px 0 2px lightgrey;">
      <button type="submit" class="btn btn-primary">@lang('admin.Create')</button>
      <button type="button" data-url="{{ url('admin/partners') }}" onclick="if(!confirm('Вы уверены, что хотите отменить изменения?')) {return false} else {window.location.href = this.dataset.url}" class="ml-3 btn btn-outline-warning">@lang('admin.Cancel')</button>
    </div>
  </form>
  @push('scripts')
  <script>

    /* Dropzone */
    let uploadFile = new Dropzone('#uploadFile', {
      url: '/admin/upload',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      maxFiles: 1,
      dictMaxFilesExceeded: "Достигнут лимит загрузки файлов, разрешено 1",
      acceptedFiles: 'image/*',
      dictInvalidFileType: 'Не разрешены к загрузке файлов',
      paramName: 'file',
      maxFilesize: 2,
      dictFileTooBig: "Максимальный размер файла 2 MB",
      init: function() {
        this.element.innerHTML = `<div class="dz-message needsclick">
          <h5 class="text-primary mt-5">@lang('admin.DropFilesHereOrClickToUpload')</h5>
        </div>`
      },
      success: function(file, response) {
        file.previewElement.classList.add('dz-success')
        document.querySelector('.upload-preview').innerHTML = `<div class="position-relative mb-3">
            <img class="w-100" src="${file.dataURL}">
            <button type="button" onclick="if(confirm('Вы уверены, что хотите удалить изображение?')) {this.parentElement.remove(); document.getElementById('inputPicture').value = ''}" class="btn btn-sm btn-danger position-absolute" style="left: 10px; top: 10px;"><i class="feather icon-trash"></i></button>
          </div>`
        if( response.status == 'success' ) {
          //document.querySelector('#inputPicture').value = file.dataURL
          document.querySelector('#inputPicture').value = response.tempFilename
        }
      },
      complete: function (file) {
        this.removeFile(file)
      },
      error: function (file, response) {
        file.previewElement.classList.add('dz-error')
      }
    })

    // Submit Form
    const inputName = document.getElementById('inputName')
    const inputSurname = document.getElementById('inputSurname')
    const inputEmail = document.getElementById('inputEmail')
    const inputPhone = document.getElementById('inputPhone')
    const inputCompany = document.getElementById('inputCompany')
    const inputCity = document.getElementById('inputCity')
    const inputAddress = document.getElementById('inputAddress')
    const inputCoordinates = document.getElementById('inputCoordinates')
    const inputSite = document.getElementById('inputSite')
    const inputSchedule = document.getElementById('inputSchedule')
    const inputOrderBy = document.getElementById('inputOrderBy')
    const inputStatus = document.getElementById('inputStatus')
    const inputPicture = document.getElementById('inputPicture')

    const partnerForm = document.getElementById('partnerForm')
    partnerForm.onsubmit = function(event) {
      event.preventDefault()

      const url = partnerForm.getAttribute('action')

      const submitBtn = partnerForm.querySelector('button[type="submit"]')
      submitBtn.setAttribute('disabled', true)
      document.querySelector('.threebody-loader').style.display = 'flex'

      fetch(url, {
        method: 'POST',
        headers: {
          'Content-type': 'application/json; charset=UTF-8',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          name: inputName.value,
          surname: inputSurname.value,
          email: inputEmail.value,
          phone: inputPhone.value,
          company: inputCompany.value,
          city: inputCity.value,
          address: inputAddress.value,
          coordinates: inputCoordinates.value,
          site: inputSite.value,
          schedule: inputSchedule.value,
          order_by: inputOrderBy.value,
          status: inputStatus.checked,
          picture: inputPicture.value
        })
      }).then(response => response.json()).then(data => {

        submitBtn.removeAttribute('disabled')
        document.querySelector('.threebody-loader').style.display = 'none'

        console.log(data);

        if(data.status == 'success') {
          uploadFile.removeAllFiles()
          window.location.href = url
        } else {

          let errors = data.errors
          console.log(errors);
          
          if(errors['company']) {
            inputCompany.nextElementSibling.textContent = errors['company']
          } else {
            inputCompany.nextElementSibling.textContent = ''
          }

        }
      }).catch(error => console.error(error.message))
    }
  </script>
  @endpush
</x-admin-layout>

