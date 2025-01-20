<script src="{{asset('assets/libs/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/js/butterup/butterup.min.js')}}"></script>
<script src="{{asset('assets/js/lightbox/lightbox.js')}}"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<style>
	.fancybox__slide.has-image>.fancybox__content {
		background: white;
		padding: 20px;
		width: 60%!important;
	}
</style>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
	Fancybox.bind("[data-fancybox]", {
	  // Your custom options
	})
</script>

{{-- <script defer src="{{asset('assets/js/fslightbox.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/axios.min.js')}}"></script>
<script src="{{asset('assets/js/imask.min.js')}}"></script>
<script src="{{asset('assets/js/form-saver.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script> --}}
@vite(['resources/js/app.js'])