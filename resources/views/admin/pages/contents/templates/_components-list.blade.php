<ul class="collapsible popout" data-collapsible="accordion" >
    <li v-for="component in list">
        <div class="collapsible-header">

            <div class="pull-left">
                <span class="btn-floating waves-effect waves-light">
                    <i class="small">&uarr;</i>
                </span>
                <span class="btn-floating waves-effect waves-light">
                    <i class="small">
                        &darr;
                    </i>
                </span>
            </div>
            <div class="pull-right" v-if="section.type.unlimited">
                {!! Form::open([
					'method'				=> 'DELETE',
					'route'					=> ['admin::pages.sections.ajax.components.destroy','&#123;&#123;section.id&#125;&#125;','&#123;&#123;component.id&#125;&#125;'],
					'role'					=> 'form' ,
					'id'					=> 'delete_compoment-&#123;&#123;component.id&#125;&#125;_form',
					'class'					=> '',
					'data-index'			=> '&#123;&#123;$index&#125;&#125;',
					'v-on:submit.prevent'	=> 'post'
				]) !!}

					<button type="submit" class=" btn-floating waves-effect waves-light deep-orange accent-2" form ="delete_compoment-&#123;&#123; component.id &#125;&#125;_form">
						<i class="material-icons">delete</i>
					</button>

				{!!Form::close()!!}
            </div>
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
