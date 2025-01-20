<x-admin-layout>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title"></div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#!">Режим работы корзины</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header">
          <h5>Режим работы корзины</h5>
        </div>
        <div class="card-body">
          <div class="row">
            {{-- <div class="col-md-3">
              <div class="form-group row">
                <label for="inputKey" class="col-sm-8 col-form-label col-form-label-sm">Начало работы корзины</label>
                <div class="col-sm-4">
                  <input type="time" value="11:00" class="form-control form-control-sm" id="inputCartStart">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputValue" class="col-sm-8 col-form-label col-form-label-sm">Конец работы корзины</label>
                <div class="col-sm-4">
                  <input type="time" value="22:00" class="form-control form-control-sm" id="inputCartEnd">
                </div>
              </div>
            </div> --}}
            <div class="col-md-12">
              
              <table class="table table-sm">
                <thead>
                  <tr>
                    <td>Понедельник</td>
                    <td>Вторник</td>
                    <td>Среда</td>
                    <td>Четверг</td>
                    <td>Пятница</td>
                    <td>Суббота</td>
                    <td>Воскресенье</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="time" value="{{ $schedule->Monday->start }}" class="form-control form-control-sm" id="inputCartStartMonday"></td>
                    <td><input type="time" value="{{ $schedule->Tuesday->start }}" class="form-control form-control-sm" id="inputCartStartTuesday"></td>
                    <td><input type="time" value="{{ $schedule->Wednesday->start }}" class="form-control form-control-sm" id="inputCartStartWednesday"></td>
                    <td><input type="time" value="{{ $schedule->Thursday->start }}" class="form-control form-control-sm" id="inputCartStartThursday"></td>
                    <td><input type="time" value="{{ $schedule->Friday->start }}" class="form-control form-control-sm" id="inputCartStartFriday"></td>
                    <td><input type="time" value="{{ $schedule->Saturday->start }}" class="form-control form-control-sm" id="inputCartStartSaturday"></td>
                    <td><input type="time" value="{{ $schedule->Sunday->start }}" class="form-control form-control-sm" id="inputCartStartSunday"></td>
                  </tr>
                  <tr>
                    <td><input type="time" value="{{ $schedule->Monday->end }}" class="form-control form-control-sm" id="inputCartEndMonday"></td>
                    <td><input type="time" value="{{ $schedule->Tuesday->end }}" class="form-control form-control-sm" id="inputCartEndTuesday"></td>
                    <td><input type="time" value="{{ $schedule->Wednesday->end }}" class="form-control form-control-sm" id="inputCartEndWednesday"></td>
                    <td><input type="time" value="{{ $schedule->Thursday->end }}" class="form-control form-control-sm" id="inputCartEndThursday"></td>
                    <td><input type="time" value="{{ $schedule->Friday->end }}" class="form-control form-control-sm" id="inputCartEndFriday"></td>
                    <td><input type="time" value="{{ $schedule->Saturday->end }}" class="form-control form-control-sm" id="inputCartEndSaturday"></td>
                    <td><input type="time" value="{{ $schedule->Sunday->end }}" class="form-control form-control-sm" id="inputCartEndSunday"></td>
                  </tr>
                </tbody>
              </table>
              <button class="btn btn-sm btn-primary" id="btnSaveCartSchedule">Сохранить</button>
            </div>
          </div>
          <hr>
          <div id="calendar"></div>
        </div>
      </div>
    </div>
  </div>

  <div id="eventModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">Создание</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form id="eventForm" novalidate>
            <div class="form-group row">
              <label for="inputTitle" class="col-sm-3 col-form-label col-form-label-sm">Название</label>
              <div class="col-sm-9">
                <select class="form-control form-control-sm" id="inputTitle">
                  <option value="Корзина" selected>Режим работы корзины</option>
                </select>
                <div id="inputTitleError"></div>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputStart" class="col-sm-3 col-form-label col-form-label-sm">Начало</label>
              <div class="col-sm-9">
                <input type="time" class="form-control form-control-sm" id="inputStartTime" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputValue" class="col-sm-3 col-form-label col-form-label-sm">Конец</label>
              <div class="col-sm-9">
                <input type="time" class="form-control form-control-sm" id="inputEndTime" required>
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

  <div id="editEventModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">Редактирование</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form id="eventForm" novalidate>
            <div class="form-group row">
              <label for="inputTitle" class="col-sm-3 col-form-label col-form-label-sm">Название</label>
              <div class="col-sm-9">
                <select class="form-control form-control-sm" id="inputTitle">
                  <option value="Корзина" selected>Режим работы корзины</option>
                </select>
                <div id="inputTitleError"></div>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputStart" class="col-sm-3 col-form-label col-form-label-sm">Начало</label>
              <div class="col-sm-9">
                <input type="time" class="form-control form-control-sm" id="inputEidtStartTime" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputValue" class="col-sm-3 col-form-label col-form-label-sm">Конец</label>
              <div class="col-sm-9">
                <input type="time" class="form-control form-control-sm" id="inputEditEndTime" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-sm btn-primary">Создать</button>
                <button type="button" onclick="deleteEvent()" data-id="8" class="btn btn-sm btn-danger">Удалить</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')

  
  
  
  <script src={{ asset('admin/js/fullcalendar/index.global.min.js') }}></script>
  <script src={{ asset('admin/js/fullcalendar/packages/core/locales/ru.global.js') }}></script>
  <script>

      const btnSaveCartSchedule = document.getElementById('btnSaveCartSchedule')
      btnSaveCartSchedule.addEventListener('click', function() {
        const values = {
          Monday: {
            start: document.getElementById('inputCartStartMonday').value,
            end: document.getElementById('inputCartEndMonday').value,
          },
          Tuesday: {
            start: document.getElementById('inputCartStartTuesday').value,
            end: document.getElementById('inputCartEndTuesday').value,
          },
          Wednesday: {
            start: document.getElementById('inputCartStartWednesday').value,
            end: document.getElementById('inputCartEndWednesday').value,
          },
          Thursday: {
            start: document.getElementById('inputCartStartThursday').value,
            end: document.getElementById('inputCartEndThursday').value,
          },
          Friday: {
            start: document.getElementById('inputCartStartFriday').value,
            end: document.getElementById('inputCartEndFriday').value,
          },
          Saturday: {
            start: document.getElementById('inputCartStartSaturday').value,
            end: document.getElementById('inputCartEndSaturday').value,
          },
          Sunday: {
            start: document.getElementById('inputCartStartSunday').value,
            end: document.getElementById('inputCartEndSunday').value,
          }
        }

        const xhr = new XMLHttpRequest()
        xhr.open('POST','/admin/settings/update/14',true)
        xhr.setRequestHeader('Content-type','application/json')
        xhr.setRequestHeader('X-CSRF-TOKEN','{{ csrf_token() }}')
        xhr.send(JSON.stringify({
          id: 14,
          value: values
        }))
        xhr.onreadystatechange = function() {
          if(xhr.readyState==4 && xhr.status==200) {
            let response = xhr.responseText
            let message = 'График работы корзины успешно обновлен'
            $('.toast .toast-body').text(message)
            $('.toast').toast('show')
          }
        }

      })

      /*function deleteEvent() {
        const id = event.target.dataset.id
        if(id && confirm('Вы уверены, что хотите удалить эту запись?')) {
          fetch('/admin/calendar/' + id, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          }).then(response => response.json()).then(data => {
            if(data.status == 'success') {
              $('#calendar').fullCalendar('removeEvents', id)
              $('#editEventModal').modal('hide')
              $('.toast .toast-body').text(data.message)
              $('.toast').toast('show')
            }
          }).catch(err => console.error(err.message))
        }
      }

      document.addEventListener('DOMContentLoaded', function() {

        let events = @json($events)

        const calendarEl = document.getElementById('calendar')
        var calendar = new FullCalendar.Calendar( calendarEl , {
          initialView: 'dayGridMonth',
          locale: 'ru',
          headerToolbar: {
            start: 'prev,next today',
            center: 'title',
            end: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          editable: true,
          eventDrop: function(e) {
            let id = e.event.id
            let start = moment(e.event.start).format('YYYY-MM-DD')
            let end = moment(e.event.end).format('YYYY-MM-DD')

            fetch('/admin/calendar/' + id, {
              method: 'PUT',
              headers: {
                'Content-type': 'application/json; charset=UTF-8',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
              body: JSON.stringify({
                start: start,
                end: end
              })
            }).then(response => response.json()).then(data => {
              if(data.status == 'success') {
                $('.toast .toast-body').text(data.message)
                $('.toast').toast('show')
              }
            }).catch(err => console.error(err.message))


          },
          eventClick: function(e) {
            let id = e.event.id
            let start = moment(e.event.start).format('YYYY-MM-DD')
            let end = moment(e.event.end).format('YYYY-MM-DD')

            fetch('/admin/calendar/' + id).then(response => response.json()).then(data => {
              document.getElementById('inputEditStartTime').value = "22:53:05"
              if(data.status == 'success') {

                
                document.getElementById('inputEditEndTime').value = data.event.end_time

                $('#editEventModal').modal('show')
              }
            }).catch(err => console.error(err.message))
          },
          selectable: true,
          //selectHelper: true,
          //selectAllow: function(event) {
            //return moment(event.start).utcOffset(false).isSame(moment(event.end).substract(1, 'second').utcOffset(false), 'day')
          //}, 
          select: function({start, end, allDay}) {
            
            $('#eventModal').modal('toggle')

            document.getElementById('eventForm').addEventListener('submit', function(e){
              e.preventDefault()
              let title = document.getElementById('inputTitle').value
              let startDate = moment(start).format('YYYY-MM-DD')
              let endDate = moment(end).format('YYYY-MM-DD')
              let startTime = document.getElementById('inputStartTime').value
              let endTime = document.getElementById('inputEndTime').value

              fetch('/admin/calendar', {
                method: 'POST',
                headers: {
                  'Content-type': 'application/json; charset=UTF-8',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                  title: title,
                  start: startDate,
                  end: endDate,
                  start_time: startTime,
                  end_time: endTime,
                })
              }).then(response => response.json()).then(data => {
                 $('#calendar').fullCalendar('refetchEvents')
                $('#calendar').fullCalendar('renderEvent', {
                  title: data.title,
                  start: data.start,
                  end: data.end
                })
                $('#eventModal').modal('hide')
                //if(data.status == 'success') {
                  //alert('Event created successfully')
                //}
              }).catch(err => console.error(err.message))

            })


            var title = prompt('Event title:')
            if( title ) {
              var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss')
              var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss')

              

            }
          },          
          events: events
        })
        calendar.render()
      })*/

    </script>
  @endpush
</x-admin-layout>
