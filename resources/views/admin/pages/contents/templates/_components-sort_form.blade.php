{!! Form::open([
    'method'                => "PATCH",
    'route'                 => ['admin::pages.sections.ajax.components.sort','&#123;&#123;section.id&#125;&#125;'],
    'role'                  => 'form' ,
    'id'                    => '&#123;&#123;section.index+"_sort_components_form"&#125;&#125;',
	'v-on:submit.prevent'	=> 'post',
    'v-if'                  => 'list.length > 1',
    ]) !!}
    <input
        type="hidden"
        v-for="id in sorted_ids"
        :form="section.index+'_sort_components_form'"
        name="components[]"
        :value="id">
    <div class="pull-right pageslists--save-button mt-5">
        {!! Form::submit(trans('manage_pages.contents.components.sort.save') , [
            'class' => 'btn waves-effect waves-light',
            'form'  => '&#123;&#123;section.index+"_sort_components_form"&#125;&#125;'
        ]) !!}
    </div>
{!! Form::close() !!}
