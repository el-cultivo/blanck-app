<template id="section-multiple-unlimited-template">
    <div class="">
        <div class="col s10 offset-s1 center-align">
            <h5>@{{section.index}}</h5>
            @include('admin.pages.contents.templates._components-create_form')
            @include('admin.pages.contents.templates._components-list')
            @include('admin.pages.contents.templates._components-sort_form')
        </div>
        <div class="col s12 ">
            <div class="divider" ></div>
        </div>
    </div>
</template>
