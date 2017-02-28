<template id="section-multiple-fixed-template">
    <div >
        <div class="col s10 offset-s1 center-align">
            <h5 id="section-@{{section.index}}">@{{section.index}}</h5>

            @include('admin.pages.contents.templates._components-list')
        </div>

        <div class="col s12 ">
            <div class="divider">

            </div>
        </div>
    </div>
</template>
