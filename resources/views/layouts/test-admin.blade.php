<!DOCTYPE html>
<html lang="{{ $current_lang_iso }}">
	@include('admin.general.head')

	<body id="admin-vue" class="admin">
		{{-- @include('general._alerts') --}}
		{{-- @include('admin.general._menu') --}}
		<div class="">
			<div class="row">

				<div class="col s12 main">

					<section class="row content">
						@yield('content')
					</section>

				</div>

			</div>

		</div>

		@yield('modals')

		@include('admin.general.scripts')

	</body>

	@yield('vue_templates')

</html>
