{!! Form::open([
    'method'                => "PATCH",
    'route'                 => 'admin::pages.sort',
    'role'                  => 'form' ,
    'id'                    => '&#123;&#123;index+"_sort_page_form"&#125;&#125;',
    'v-if'                  => 'list.length > 1',
    ]) !!}
    <input
        type="hidden"
        v-for="id in sorted_ids"
        :form="index+'_sort_page_form'"
        name="pages[]"
        :value="id">
    <div class="pull-right pageslists--save-button">
        {!! Form::submit("Guardar orden", [
            'class' => 'btn waves-effect waves-light',
            'form'  => '&#123;&#123;index+"_sort_page_form"&#125;&#125;'
        ]) !!}
    </div>
{!! Form::close() !!}
