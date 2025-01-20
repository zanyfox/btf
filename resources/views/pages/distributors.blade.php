@extends('layouts/app')

@section('title', $page->metatitle ?? $page->title)
@section('keywords', $page->keywords)
@section('description', $page->description)

@section('content')

<section class="city-selection">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 store-box">
        <h5>Выберите город:</h5>
        <div class="custom-select">
          <div class="selected-box">
            <span class="selected-text">Все города</span>
            <img src="{{ asset('assets/images/arrow-down.svg') }}" alt="">
          </div>
          @if($distributorCities)
          <div class="options">
          <div class="option">Все города</div>
          @foreach($distributorCities as $city)
            <div class="option">{{ $city }}</div>
          @endforeach
          </div>
          @endif
        </div>

        @if (!empty($distributors))
          @foreach ($distributors as $distributor)
          <div class="store" data-city="{{ $distributor->city }}">
            <a class="store-title" href="javascript:void(0)">{{ $distributor->company }}</a>
            <p><span class="store-address">{{ $distributor->address }}</span><br>
              <a href="tel:{{ $distributor->phone }}" class="store-phone" style="color: inherit;">{{ $distributor->phone }}</a><br>
			  <a href="mailto:{{ $distributor->email }}" class="store-email" style="color: inherit;">{{ $distributor->email }}</a><br>
              {{ $distributor->schedule }}</p>
          </div>
          @endforeach
        @endif
      </div>

      <div class="col-lg-8 offset-lg-1 map-box">
        <div class="map">
          <div id="map" class="indx_map" fetchpriority="high" style="width: 100%; height: 650px;"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- city-selection -->

<!-- partner -->
<section class="partner">
  <div class="relative-box">
    <div class="group-product__img">
      <img class="group-product__img-bg" src="{{ asset('assets/images/group-product-bg.svg') }}" alt="">
      <img class="group-product" src="{{ asset('assets/images/group-product.png') }}" alt="">
    </div>
    <div class="container">
      <div class="title-box">
        <h2 class="title-text">{{ $page->subtitle }}</h2>
        <h2 class="title-text__bg">Partnership</h2>
        <div class="sub-title">
          {!! $page->text !!}
        </div>
      </div>
      <form action="{{ route('send') }}" method="POST" class="partner-form" id="partnerForm">
        @csrf
        <div class="input-box">
          <div>
            <input type="text" name="name" placeholder="Ваше имя*" required>
            <small></small>
          </div>
          <div>
            <input type="text" name="surname" placeholder="Ваша фамилия">
            <small></small>
          </div>
          <div>
            <input type="text" name="city" placeholder="Город*" required>
            <small></small>
          </div>
          <div>
            <input type="text" name="company" placeholder="Компания*" required>
            <small></small>
          </div>
          <div>
            <input type="tel" name="phone" placeholder="Телефон*" id="phone-mask" required>
            <small></small>
          </div>
          {{-- @guest --}}
          <div>
            <input type="email" name="email" id="feedbackEmail" placeholder="E-mail*" required>
            <small></small>
          </div>
          {{-- @endguest --}}
        </div>
        <button type="submit" class="send-btn">ОТПРАВИТЬ</button>
        <p class="politica-info">Нажимая на кнопку «Оставить заявку» вы соглашаетесь с <br><a href="{{ url('processing-personal-data') }}">политикой обработки персональных данных.</a></p>
      </form>
    </div>
  </div>
</section>

<style>
	@media screen and (max-width: 768px) {
	    .map-box .map #map {
	        height: 248px!important;
	    }
	}
</style>

@push('scripts')
<script>
	
	document.addEventListener("DOMContentLoaded", (event) => {
		
		const script = document.createElement('script')
		script.src = 'https://api-maps.yandex.ru/2.1/?apikey=388a2222-79af-4a68-9aee-366c805c4825&lang=ru_RU'
		document.querySelector('.map').appendChild(script)
		
		let selectedStores = []
		let stores = document.querySelectorAll('.store')
		if(stores.length > 0) {
			for(let store of stores) {
				let storeCity = store.dataset.city
				selectedStores.push({
					city: storeCity,
					title: store.querySelector('.store-title').textContent,
					address: store.querySelector('.store-address').textContent,
					phone: store.querySelector('.store-phone').textContent,
					email: store.querySelector('.store-email').textContent,
				})
			}
		}
		
		let coords = ['54.735152', '55.958736']
		let zoom = 4
		
        setTimeout(function () {
			initMap(coords, zoom, selectedStores)            
        }, 1000)
		
	})
	
	
	
	function initMap(coords, zoom, stores) {
		
        const myMap = new ymaps.Map('map', {
          center: coords,
          zoom: zoom,
          controls: ['zoomControl'],
        }, {
          searchControlProvider: 'yandex#search'
        }),
        MyIconContentLayout = ymaps.templateLayoutFactory.createClass('<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>')

        stores.forEach(item => {
	        ymaps.geocode(`${item.city}, ${item.address}`).then(function (res) {
	          baloon = res.geoObjects.get(0).geometry.getCoordinates();
	          myPlacemark = new ymaps.Placemark([baloon[0], baloon[1]], {
	            balloonContent: `<span><b>${item.title}</b></span><br><span>${item.address}<br><a href="tel:${item.phone}">${item.phone}</a><br><a href="mailto:${item.email}">${item.email}</a></span>`
	          }, {
	            iconLayout: 'default#imageWithContent',
	            iconImageHref: '/assets/images/marker.svg',
	            iconImageSize: [30, 30],
	            iconImageOffset: [-15, -15],
	            //iconContentOffset: [15, 15],
	            iconContentLayout: MyIconContentLayout
	          })
	          myMap.geoObjects.add(myPlacemark)
	        })
        })

	}
	
  	const selectedText = document.querySelector('.selected-text')
	if(selectedText) {
	let observer = new MutationObserver(function(mutations) {
	    mutations.forEach(function(mutation) {
			if(mutation.target.innerText && mutation.target.innerText != 'Все города') {
				let stores = document.querySelectorAll('.store')
				if(stores.length > 0) {
					let selectedStores = []
					for(let store of stores) {
						let storeCity = store.dataset.city
						if(storeCity) {
							if(storeCity == mutation.target.innerText) {
								store.classList.remove('d-none')
								selectedStores.push({
									city: storeCity,
									title: store.querySelector('.store-title').textContent,
									address: store.querySelector('.store-address').textContent,
									phone: store.querySelector('.store-phone').textContent,
								})
							} else {
								store.classList.add('d-none')
							}
						}
					}

					ymaps.geocode(mutation.target.innerText, {
					    results: 1
					}).then(function (res) {
					        var firstGeoObject = res.geoObjects.get(0),
					        coords = firstGeoObject.geometry.getCoordinates()
							document.getElementById('map').innerHTML = ''
						

							if(selectedStores.length > 0) {
								initMap(coords, 11, selectedStores) 
							}

					    })
				}
			} else {
				let coords = ['54.735152', '55.958736']
				let selectedStores = []
				let stores = document.querySelectorAll('.store')
				
				if(stores.length > 0) {
					let selectedStores = []
					for(let store of stores) {
						let storeCity = store.dataset.city
						//if(storeCity) {
							store.classList.remove('d-none')
								selectedStores.push({
									city: storeCity,
									title: store.querySelector('.store-title').textContent,
									address: store.querySelector('.store-address').textContent,
								})
						//}
					}
					document.getElementById('map').innerHTML = ''
					initMap(coords, 4, selectedStores)
				}
				
			}
	    });    
	});
	observer.observe(
	    selectedText,
	    {
	        childList: true,
	        attributes: true,
	        subtree: true,
	        characterData: true,
	        attributeOldValue: true,
	        characterDataOldValue: true,
	        //attributeFilter: true
	    }
	);
}

  const partnerForm = document.querySelector('#partnerForm')
  partnerForm.addEventListener('submit', function(e) {
    e.preventDefault()

    const inputName = this.querySelector('[name="name"]')
    const inputSurname = this.querySelector('[name="surname"]')
    const inputPhone = this.querySelector('[name="phone"]')
    const inputEmail = this.querySelector('[name="email"]')
    const inputCity = this.querySelector('[name="city"]')
    const inputCompany = this.querySelector('[name="company"]')

    let formData = new FormData()
    formData.append('name', inputName.value)
    formData.append('surname', inputSurname.value)
    formData.append('phone', inputPhone.value)
    formData.append('email', inputEmail.value)
    formData.append('subject', 'Заявка с сайта')
    formData.append('city', inputCity.value)
    formData.append('company', inputCompany.value)

    axios.post('/send', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    }).then(response => {
      let {data} = response
      if( data.status == 'success' ) {
        inputName.value = ''
        inputSurname.value = ''
        inputPhone.value = ''
        inputEmail.value = ''
        inputCity.value = ''
        inputCompany.value = ''

        butterup.toast({
          title: 'Заявка на партнерство',
          message: 'Ваша заявка успешно отправлена',
          type: 'success',
          icon: false,
          maxToasts: 3,
          toastLife: 30000000,
          dismissable: true,
        })
      } else {
        let errors = data.errors
        if(errors['name']) {
          inputName.nextElementSibling.textContent = errors['name']
        } else {
          inputName.nextElementSibling.textContent = ''
        }

        if(errors['phone']) {
          inputPhone.nextElementSibling.textContent = errors['phone']
        } else {
          inputPhone.nextElementSibling.textContent = ''
        }
        
      }
    
    }).catch(() => {

      butterup.toast({
        title: 'Заявка на партнерство',
        message: 'Ошибка при отправке заявки',
        type: 'danger',
        icon: false,
        maxToasts: 3,
        toastLife: 3000,
        dismissable: false,
      })

    })

  })  
</script>
@endpush
@endsection
