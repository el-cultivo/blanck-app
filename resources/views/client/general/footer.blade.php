<footer class="footer">
	<div class="wrap">
		<div class="footer__logo">
			<img class="footer__logo-default" src="{{ asset('images/logo-hover.svg') }}">
		</div>
		<div class="footer__menu">
			@include('client.general._menu', [
				'menu'	=> 'footer',
				'class'	=> 'footer__menu-item',
			])
			<div class="footer__social">
				<p class="footer__social-text">&iexcl;S&iacute;guenos!</p>
				@include('client.general._social', [ 'class' => 'footer__social-item' ])
			</div>
		</div>
	</div>
</footer>
