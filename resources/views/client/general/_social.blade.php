@foreach ($social_networks as $social_network => $link )
	<a target="_blank" class="{{ $class }} fa fa-{{$social_network}}" href="{{ $link }}"></a>
@endforeach
