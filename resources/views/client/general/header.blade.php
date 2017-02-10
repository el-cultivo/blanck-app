
<header class="header">
	<div class="wrap">
		<a class="header__logo" href="/">
			<img class="header__logo--img" src="{{ asset('images/logo.svg') }}">
		</a>
		<div class="header__menu">
			@include('client.general._menu', [
				'menu'	=> 'main',
				'class'	=> 'header__menu-item a_JS',
			])
		</div>
		<div class="header__social">
			@include('client.general._social', [ 'class' => 'header__social-item' ])
		</div>
		@if (isset($user) && $user->hasPermission('admin_access'))
			<div class="user-admin-link"><a href="{{ route("admin::index") }}">Admin</a></div>
		@endif
		<div class="header__mobile--btn mobile_btn_JS">&#9776;</div>
		<div class="clear"></div>
	</div>
	<div class="header__mobile mobile_JS">
		@include('client.general._menu', [
			'menu'	=> 'mobile',
			'class'	=> 'header__mobile--item',
		])
		<div class="header__mobile--item">
			@include('client.general._social', [ 'class' => '' ])
		</div>
	</div>
</header>
