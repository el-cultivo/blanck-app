@if ($menu == 'main')
    @foreach ($header_items as $page)
        <a id="{{$page->translation()->slug}}" class="{{$class}}" href="{{ route('client::show', $page->translation()->slug ) }}" >{{$page->translation()->name}}</a>
    @endforeach
@elseif ($menu == 'footer' || $menu == 'mobile')
    @foreach ($footer_items as $page)
        <a class="{{$class}}" href="{{ route('client::show', $page->translation()->slug ) }}">{{$page->translation()->name}}</a>
    @endforeach
@endif
