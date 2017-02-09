<div class="sidebar__main">

	<a class="sidebar__main--logo" href="{{ route("client::index") }}" alt="{{ env('APP_NAME') }}" style="background-image:url({{ asset('images/logo.svg') }});">
	</a>

	<div class="sidebar__main--profile">

		<!-- Dropdown Trigger -->
		<div class='dropdown-button sidebar__main--profile--dropDown' href='#' data-activates='dropdown1'>
			<span class="sidebar__main--profile--app-name">{{ env('APP_NAME') }}</span>
			<span class="sidebar__main--profile--profile-name">{{ $user->full_name }}</span>
		</div>

		<!-- Dropdown Structure -->
		<ul id='dropdown1' class='dropdown-content sidebar__main--profile--dropDown-ul'>
			<li><a href="{{ route("user::home", $user->name) }}" class="sidebar__main--profile--dropDown-ul--link">Mi perfil</a></li>
			<li><a href="{{ route("client::index") }}" class="sidebar__main--profile--dropDown-ul--link">Ver sitio</a></li>
			<li class="divider"></li>
			<li>
				{!! Form::open(['method' => 'POST', 'route' => 'client::logout']) !!}
						{!! Form::submit("Cerrar sesión", ['class' => 'sidebar__main--profile--dropDown-ul--link']) !!}
				{!! Form::close() !!}
			</li>
		</ul>

	</div>


</div>

@foreach ($menu_items as $menu_item)
	@if (!$menu_item->sub_menu->isEmpty())
		<ul class="nav sidebar__nav nav_JS">
			<label class="tree-toggler sidebar__nav-label {{ $menu_item->current ? 'label_active' : '' }} label_JS">
				{{ $menu_item->label }}
			</label>

			<ul class="sidebar__nav--nested-ul tree tree_JS">
				@foreach ($menu_item->sub_menu as $sub_menu_item )
					<li>
						<a class="sidebar__nav--nested-ul--link {{ is_page( $route_group_prefix.$sub_menu_item->name ) ? 'link_active' : '' }}" href="{{route($route_group_prefix.$sub_menu_item->name)}}">{{$sub_menu_item->label}}</a>
					</li>
				@endforeach
			</ul>
		</ul>
	@endif
@endforeach
