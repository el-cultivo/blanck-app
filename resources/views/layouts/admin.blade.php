<!DOCTYPE html>
<html lang="{{ $current_lang_iso }}">

	@include('admin.general.head')

	<body id="admin-vue" class="admin">

		@include('general._alerts')

		<div class="row">


			@include('admin.general._sidebar')


			<div class="main">

				@include('admin.general._header')

				<section class="row content">
					@yield('content')
				</section>

				@include('admin.general._footer')

			</div>

		</div>

		@yield('modals')

		@include('admin.general.scripts')

		@yield('vue_templates')

	</body>

</html>
