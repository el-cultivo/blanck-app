<script  type="x/templates" id="section-{{ $section_index }}-template">
    <div >
        <div class="col s10 offset-s1 center-align">
			<h5>@{{section.label}}</h5>
			<p>
			    @{{{section.description}}}
			</p>
            @yield('page_section-content')
        </div>

        <div class="col s12 ">
            <div class="divider"></div>
        </div>
    </div>
</script >
