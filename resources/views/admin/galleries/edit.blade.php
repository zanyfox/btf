<x-admin-layout>
  <x-slot:title>@lang('admin.EditGallery')</x-slot:title>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/galleries')}}">@lang('admin.Galleries')</a></li>
            <li class="breadcrumb-item"><a href="#!">@lang('admin.EditGallery')</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  @if($errors->any())
  <div class="alert alert-warning">
    <ul>
      @foreach($errors->all() as $error)
      <li class="red-text">{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{route('admin.galleries.update', $gallery->id)}}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
    @method('PUT')
    <div class="card">
      <div class="card-header">
        <h5>@lang('admin.EditGallery')</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col col-8">
            <div class="form-group">
              <label for="inputName">@lang('admin.Name')</label>
              <input type="text" name="name" value="{{old('name') ?? $gallery->name}}" class="form-control @error('name') is-invalid @enderror" id="inputName" autofocus>
              @error('name')<span class="invalid-feedback d-block">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
              <label for="inputSlug">@lang('admin.Slug')</label>
              <input type="text" name="slug" value="{{old('slug') ?? $gallery->slug}}" class="form-control @error('slug') is-invalid @enderror" id="inputSlug">
              @error('slug')<span class="invalid-feedback d-block">{{$message}}</span>@enderror
            </div>
            <div class="form-group">
              <label for="inputDescription">@lang('admin.Description')</label>
              <textarea id="inputDescription" name="description" class="form-control hasEditor" rows="10">{{old('description') ?? $gallery->description}}</textarea>
            </div>
          </div>
          <div class="col col-4">
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="status" @checked(old('status') ?? $gallery->status) class="custom-control-input" id="customCheckStatus">
                <label class="custom-control-label" for="customCheckStatus">@lang('admin.ActiveStatus')</label>
              </div>
            </div>
            <div class="form-group">
              <label for="inputLang">@lang('admin.SelectLanguage')</label>
              <select name="lang" class="form-control" id="inputLang">
                <option value="" disabled selected>@lang('admin.ChooseLanguage')</option>
                @foreach (\App\Enums\Lang::cases() as $lang)
                <option value="{{$lang->value}}" @selected(old('lang') ?? $gallery->lang)>{{$lang->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col col-12">
            <div class="filesUpload">
              <h6>@lang('admin.Pictures')</h6>
              @if($gallery->pictures->count() > 0)
              <table id="table" class="table draggable-table">
                <caption>Drag n' Drop sorting of rows!</caption>
                <thead></thead>
                  <tr>
                    <th>@lang('admin.Image')</th>
                    <th>@lang('admin.Name')</th>
                    <th>@lang('admin.Alt')</th>
                    <th>@lang('admin.Description')</th>
                    <th>@lang('admin.Link')</th>
                    <th>@lang('admin.Path')</th>
                    <th>@lang('admin.Sort')</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($gallery->pictures as $picture)
                  <tr data-id="{{ $picture->id }}" data-sort="{{ $picture->sort }}">
                    <td>
                      <img src="{{ url('uploads/galleries/'.$picture->path) }}" width="100" alt="">
                    </td>
                    <td>{{$picture->name}} {{$picture->galleries->first()->name}}</td>
                    <td>{{$picture->alt}}</td>
                    <td>{{$picture->description}}</td>
                    <td>{{$picture->link}}</td>
                    <td>{{$picture->path}}</td>
                    <td class="sort">{{$picture->sort}}</td>
                    <td class="text-right">
                      {{-- <button class="btn btn-sm btn-info"><i class="feather icon-edit"></i></button> --}}
                      <a href="/admin/galleries/{{ $picture->id }}/deleteimage" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');"><i class="feather icon-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @endif
              <div class="mb-3">
                <label for="inputGroupFileImages">@lang('admin.ChooseFiles')</label>
                <input type="file" name="pictures[]" multiple class="form-control @error('pictures') is-invalid @enderror" id="inputGroupFileImages">
              </div>
              @error('pictures')
              <div class="invalid-feedback d-block">{{$message}}</div>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">@lang('admin.Update')</button>
  </form>
  <style>
  .draggable-table .draggable-table__drag {
    font-size: 0.95em;
    font-weight: lighter;
    text-transform: capitalize;
    position: absolute;
    width: 100%;
    text-indent: 50px;
    border: 1px solid #f1f1f1;
    z-index: 10;
    cursor: grabbing;
    -webkit-box-shadow: 2px 2px 3px 0px rgba(0, 0, 0, 0.05);
    box-shadow: 2px 2px 3px 0px rgba(0, 0, 0, 0.05);
    opacity: 1;
  }
  .draggable-table thead th {
    height: 25px;
    font-weight: bold;
    text-transform: capitalize;
    padding: 10px;
    user-select: none;
  }
  .draggable-table tbody tr {
    cursor: grabbing;
  }
  .draggable-table tbody tr td {user-select: none;}
  .draggable-table tbody tr:nth-child(even) {
    background-color: #f7f7f7;
  }
  .draggable-table tbody tr:nth-child(odd) {
    background-color: #ffffff;
  }
  .draggable-table tbody tr.is-dragging {
    background: #f1c40f;
  }
  .draggable-table tbody tr.is-dragging td {
    color: #ffe683;
  }
  </style>
  <script>
  (function() {
    "use strict"
    const table = document.getElementById('table')
    const tbody = table.querySelector('tbody')
    var currRow = null, dragElem = null, mouseDownX = 0, mouseDownY = 0, mouseX = 0, mouseY = 0, mouseDrag = false

    function init() {
      bindMouse()
    }
    
    function bindMouse() {
      document.addEventListener('mousedown', (event) => {
        if(event.button != 0) return true
        let target = getTargetRow(event.target)
        if(target) {
          currRow = target
          addDraggableRow(target)
          currRow.classList.add('is-dragging')
          let coords = getMouseCoords(event)
          mouseDownX = coords.x
          mouseDownY = coords.y
          mouseDrag = true
        }
      })
      
      document.addEventListener('mousemove', (event) => {
        if(!mouseDrag) return
        let coords = getMouseCoords(event)
        mouseX = coords.x - mouseDownX
        mouseY = coords.y - mouseDownY 
        moveRow(mouseX, mouseY)
      })
      document.addEventListener('mouseup', (event) => {
        if(!mouseDrag) return
        currRow.classList.remove('is-dragging')
        table.removeChild(dragElem)
        dragElem = null
        mouseDrag = false

        let imageId = currRow.dataset.id
        let imageSort = currRow.dataset.sort
        fetch('/admin/galleries/sortimage/' + imageId + '/' + imageSort, {
          method: 'GET',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        }).then(res => res.json()).then(data => {
          console.log(data)
        }).catch(err => console.log(err.message))
      })   
    }


    function swapRow(row, index) {
      let currIndex = Array.from(tbody.children).indexOf(currRow),
          row1 = currIndex > index ? currRow : row,
          row2 = currIndex > index ? row : currRow
      tbody.insertBefore(row1, row2)
      currRow.dataset.sort = index
      currRow.querySelector('td.sort').textContent = currIndex
    }
  
    function moveRow(x, y) {
      dragElem.style.transform = "translate3d(" + x + "px, " + y + "px, 0)";
      
      let	dPos = dragElem.getBoundingClientRect(),
          currStartY = dPos.y, currEndY = currStartY + dPos.height,
          rows = getRows()

      for(var i = 0; i < rows.length; i++) {
        let rowElem = rows[i],
            rowSize = rowElem.getBoundingClientRect(),
            rowStartY = rowSize.y, rowEndY = rowStartY + rowSize.height

        if(currRow !== rowElem && isIntersecting(currStartY, currEndY, rowStartY, rowEndY)) {
          if(Math.abs(currStartY - rowStartY) < rowSize.height / 2) {
            swapRow(rowElem, i)
          }
        }
      }
    }

    function addDraggableRow(target) {    
      dragElem = target.cloneNode(true);
      dragElem.classList.add('draggable-table__drag')
      dragElem.style.height = getStyle(target, 'height')
      dragElem.style.background = getStyle(target, 'backgroundColor') 
      for(var i = 0; i < target.children.length; i++) {
        let oldTD = target.children[i],
            newTD = dragElem.children[i];
        newTD.style.width = getStyle(oldTD, 'width')
        newTD.style.height = getStyle(oldTD, 'height')
        newTD.style.padding = getStyle(oldTD, 'padding')
        newTD.style.margin = getStyle(oldTD, 'margin')
      }      
      
      table.appendChild(dragElem)
      let tPos = target.getBoundingClientRect(),
          dPos = dragElem.getBoundingClientRect();
      dragElem.style.bottom = ((dPos.y - tPos.y) - tPos.height) + "px";
      dragElem.style.left = "-1px"
    
      document.dispatchEvent(new MouseEvent('mousemove',
        {view: window, cancelable: true, bubbles: true}
      ))   
    }  


    function getRows() {
      return table.querySelectorAll('tbody tr')
    }    

    function getTargetRow(target) {
      let elemName = target.tagName.toLowerCase()
      if(elemName == 'tr') return target
      if(elemName == 'td') return target.closest('tr')   
    }

    function getMouseCoords(event) {
      return {
        x: event.clientX,
        y: event.clientY
      }  
    }  

    function getStyle(target, styleName) {
      let compStyle = getComputedStyle(target), style = compStyle[styleName]
      return style ? style : null
    }  

    function isIntersecting(min0, max0, min1, max1) {
      return Math.max(min0, max0) >= Math.min(min1, max1) && Math.min(min0, max0) <= Math.max(min1, max1)
    }  
    init()
  })()
  </script>
</x-admin-layout>
