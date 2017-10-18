@foreach ($languages as $language)
	<a class="{{ $class }} " @if ($language->is_current) style="font-weight: bold;" @endif href="{{ $language->translate_url }}">
		{{$language->iso6391}}
	</a>
@endforeach
