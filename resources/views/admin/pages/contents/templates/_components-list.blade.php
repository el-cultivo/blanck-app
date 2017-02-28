<ul class="collapsible popout" data-collapsible="accordion" >
    <li v-for="component in list">
        <div class="collapsible-header left-align">


            <span class="btn-floating waves-effect waves-light">
                <i class="small">&uarr;</i>
            </span>
            <span class="btn-floating waves-effect waves-light">
                <i class="small">
                    &darr;
                </i>
            </span>

        </div>
        <div class="collapsible-body">
            <component-form
            :section="section"
            :component= "component"
            ></component-form>
        </div>
    </li>
</ul>

{!! Form::open([
    'method'                => "PATCH",
    'route'                 => 'admin::pages.sort',
    'role'                  => 'form' ,
    'id'                    => '&#123;&#123;section.index+"_sort_components_form"&#125;&#125;',
    'v-if'                  => 'section.type.sortable'
    // 'class'                 => 'pageslists--sort-form',
    ]) !!}

    //falta por terminar no funciona
    <input
        type="hidden"
        v-for="id in sorted_ids"
        :form="section.index+'_sort_components_form'"
        name="pages[]"
        :value="id">
    <div class="pull-right pageslists--save-button">
        {!! Form::submit("Guardar orden", [
            'class' => 'btn waves-effect waves-light',
            'form'  => '&#123;&#123;section.index+"_sort_components_form"&#125;&#125;'
        ]) !!}
    </div>
{!! Form::close() !!}
