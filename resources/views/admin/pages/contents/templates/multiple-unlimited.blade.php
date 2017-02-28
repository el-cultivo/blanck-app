<template id="section-multiple-unlimited-template">
    <div class="">
        <div class="col s10 offset-s1 center-align">
            <h5>@{{section.index}}</h5>
            {!! Form::open([
                'method'                => "PATCH",
                'route'                 => 'admin::pages.sort',
                'role'                  => 'form' ,
                'id'                    => '&#123;&#123;section.index+"_sort_components_form"&#125;&#125;',
                'v-if'                  => 'section.type.unlimited'
                // 'class'                 => 'pageslists--sort-form',
                ]) !!}

                //falta por terminar no funciona
                <div class="pull-right pageslists--save-button">
                    {!! Form::submit("Agregar", [
                        'class' => 'btn waves-effect waves-light',
                        'form'  => '&#123;&#123;section.index+"_sort_components_form"&#125;&#125;'
                    ]) !!}
                </div>
            {!! Form::close() !!}
            @include('admin.pages.contents.templates._components-list')
        </div>
        <div class="col s12 ">
            <div class="divider" ></div>
        </div>
    </div>
</template>
