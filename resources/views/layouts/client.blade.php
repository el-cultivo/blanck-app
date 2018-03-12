<!DOCTYPE html>
<html lang="{{ $current_lang_iso }}">

	{{-- Head --}}
	@include('client.general.head')

	<body id="{{isset($body_id) ? $body_id : 'main-vue'}}" :class="{noScroll_JS: bodyScrollIsDisabled}" >
		@include('general._alerts')
		{{-- trackings --}}
		@if (config("app.env") == "production" )
			@include('client.general._trackings-body')
		@endif

		{{-- Header --}}
		@include('client.general.header')

		<div class="main-wrap {{isset($main_wrap_class) ? $main_wrap_class : ''}}">

			@yield('content')

		</div>

		{{-- Footer --}}
		@include('client.general.footer')

		{{-- Scripts --}}
		@include('client.general.scripts')

	</body>

</html>
