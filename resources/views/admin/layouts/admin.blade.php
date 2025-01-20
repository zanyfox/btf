<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@isset($title) {{$title}} | @endisset {{ config('app.name', 'Admin') }}</title>
    <meta name="robots" content="none">
		<link rel="icon" type="image/jpg" href="{{ asset('assets/admin/images/favicon.jpg') }}">

		<link href="{{ asset('assets/admin/js/simple-datatables/simple-datatables.css') }}" rel="stylesheet">
		<script src="{{ asset('assets/admin/js/simple-datatables/simple-datatables.js') }}"></script>
		
    <link rel="stylesheet" href="{{ asset('assets/admin/js/butterup/butterup.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/admin/js/dropzone/dropzone.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/admin/js/bootstrap-multiselect/bootstrap-multiselect.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
		<!-- include summernote css/js -->
    <link href="{{ asset('assets/admin/js/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
		<script src="{{ asset('assets/admin/js/slugify.js') }}"></script>
    <style>
      [x-clock] {display: none!important;}
			.dropzone {
				padding: 10px;
				border-style: dashed!important; 
				border-width: 2px!important;
			}
			.dropzone .dz-preview {margin: 0 10px 10px 0;}
			.dropzone .dz-preview .dz-image {border-radius: 5px;}
    </style>
  </head>
  <body>
		
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>

		<div style="position:absolute;top:40px;right: 40px; z-index: 9999;">
			<div class="toast hide toast-right" role="alert" aria-live="assertive" data-delay="5000" aria-atomic="true">
				<div class="toast-header">
					<img src="{{ asset('assets/admin/images/logo-aimart-dark.svg') }}" alt="" class="img-fluid m-r-5" style="width:20px;">
					<strong class="mr-auto">Системное уведомление</strong>
					<small class="text-muted">Только что</small>
					<button type="button" class="m-l-5 mb-1 mt-1 close" data-dismiss="toast" aria-label="Close">
						<span>&times;</span>
					</button>
				</div>
				<div class="toast-body"></div>
			</div>
		</div>
    
		{{-- <x-admin.partials.navbar /> --}}

		@includeIf('admin.partials.navbar', ['some' => 'data'])
          
		@includeIf('admin.partials.header', ['some' => 'data'])

		<div class="pcoded-main-container">
			<div class="pcoded-content">
				{{-- @auth('admin')
				admin
				@endauth
				@guest('admin')
				guest
				@endguest --}}
				{{ $slot }}
			</div>
		</div>

		<script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
		<script src="{{ asset('assets/admin/js/butterup/butterup.min.js') }}"></script>
		<script src="{{ asset('assets/admin/js/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor-all.min.js') }}"></script>
		<script src="{{ asset('assets/admin/js/bootstrap-multiselect/bootstrap-multiselect.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> --}}
		{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>--}}
		<script src="{{ asset('assets/admin/js/plugins/bootstrap.min.js') }}"></script>

		<script src="{{ asset('assets/admin/js/summernote/summernote-bs4.min.js') }}"></script>
		<script src="{{ asset('assets/admin/js/summernote/lang/summernote-ru-RU.js') }}"></script>

		<script src="{{ asset('assets/admin/js/dom-slider.js') }}"></script>

    <script src="{{ asset('assets/admin/js/pcoded.js') }}"></script>

		<script>
			function slugify(input) {
				if (!input) {
					return ''
				}
				let slug = input.toLowerCase().trim()
				slug = slug.normalize('NFD').replace(/[\u0300-\u036f]/g, '')
				slug = slug.replace(/[^a-z0-9\s-]/g, ' ').trim()
				slug = slug.replace(/[\s-]+/g, '-')
				return slug
			}
		</script>
		@stack('scripts')
  </body>
</html>