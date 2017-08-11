<!DOCTYPE html>
<html lang="{{ config("app.locale") }}">

	{{-- Head --}}
	@include('client.general.head')

	<body id="{{isset($body_id) ? $body_id : 'main-vue'}}" :class="{noScroll_JS: bodyScrollIsDisabled}" v-cloak>
		{{-- Analytics --}}
	    @include('client.general.analytics')

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
