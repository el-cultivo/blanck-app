<!DOCTYPE html>
<html lang="es">

	@include('admin.general.head')

	<body id="admin-vue" class="admin">

		@include('general._alerts')

		<div class="row">

			<div class="sidebar">
				@include('admin.general._sidebar')
			</div>

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
