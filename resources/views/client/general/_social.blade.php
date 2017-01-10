@if ( $social_networks['facebook'] )
	<a target="_blank" class="{{ $class }} fa fa-facebook-f" href="{{ $social_networks['facebook'] }}"></a>
@endif
@if ( $social_networks['twitter'] )
	<a target="_blank" class="{{ $class }} fa fa-twitter" href="{{ $social_networks['twitter'] }}"></a>
@endif
@if ( $social_networks['instagram'] )
	<a target="_blank" class="{{ $class }} fa fa-instagram" href="{{ $social_networks['instagram'] }}"></a>
@endif
