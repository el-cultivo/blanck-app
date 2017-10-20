<template id="pagesections-checkbox-template">
	<div class="col s10  offset-s1">
		<a data-target="pagesections-modal-create" class="modal-trigger select--modal-trigger">{!! trans('manage_pages.sections.checkbox.add') !!}</a>

		<div class="row">
			{!! Form::open([
				'method'                => 'patch',
				'route'                => ['admin::pages.sections.ajax.association',$page_edit->id,'&#123;&#123;section.id&#125;&#125;'],
				'role'                  => 'form' ,
				'id'                    => 'update_section_asociation-&#123;&#123;section.id&#125;&#125;_form',
				'class'                 => 'col s4',
				'v-for'    				=> 'section in list'
			]) !!}

				{!! Form::checkbox('section[&#123;&#123;section.id&#125;&#125;]', '&#123;&#123;section.id&#125;&#125;', null, [
					'class'     	=> '',
					'id'      		=> 'section_&#123;&#123;section.id&#125;&#125;',
					'form'      	=> 'update_section_asociation-&#123;&#123;section.id&#125;&#125;_form',
					'value'      	=> '&#123;&#123;section.id&#125;&#125;',
					':checked'		=> 'is_checked(section.id)',
					'v-model'    	=> 'selected_checkboxes',
					'v-on:change'   => 'makePost',
				]) !!}

				<label for="section_&#123;&#123;section.id&#125;&#125;" class="">
					&#123;&#123;section.index&#125;&#125;
				</label>

			{!!Form::close()!!}
		</div>

	</div>
</template>
