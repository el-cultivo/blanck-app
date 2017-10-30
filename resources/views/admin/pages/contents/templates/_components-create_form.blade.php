{!! Form::open([
    'method'                => "POST",
    'route'                 => ['admin::pages.sections.ajax.components.store','&#123;&#123;section.id&#125;&#125;'],
    'role'                  => 'form' ,
    'id'                    => '&#123;&#123;"create_component_"+section.index+"_form"&#125;&#125;',
    // 'v-if'                  => 'section.type.unlimited',
    'v-on:submit.prevent'  => 'post'
    ]) !!}
    <div class="pull-right pageslists--save-button mb-5">
        {!! Form::submit(trans('manage_pages.contents.components.sort.add'), [
            'class' => 'btn waves-effect waves-light',
            'form'  => '&#123;&#123;"create_component_"+section.index+"_form"&#125;&#125;'
        ]) !!}
    </div>
    <br>
    <br>
{!! Form::close() !!}
