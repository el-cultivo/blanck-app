<template id="pagesections-sort-template">
	<div class="col s10  offset-s1">

        <table class="bordered highlight responsive-table dataTable_JS">
            <thead class="">
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody class="collection" v-sortable="{onUpdate: onUpdate, onMove: onMove, handle: '.handle', group: label}">
                <tr  v-for="section in list" >
                    <td>
                        <span class="btn-floating waves-effect waves-light">
                            <i class="small">&uarr;</i>
                        </span>
                        <span class="btn-floating waves-effect waves-light">
                            <i class="small">
                                &darr;
                            </i>
                        </span>
                    </td>
                    <td>
                        @{{{ section.index }}}
                    </td>
                </tr>
            </tbody>
        </table>

		{!! Form::open([
		    'method'                => "PATCH",
		    'route'                 => ['admin::pages.sections.ajax.sort',$page_edit],
		    'role'                  => 'form' ,
		    'id'                    => 'sort_page_sections_form',
		    'class'                 => 'pageslists--sort-form',
			'v-on:submit.prevent'   => 'post'
		    ]) !!}
		    <input
		        type="hidden"
		        v-for="id in sorted_ids"
		        :form="sort_page_sections_form"
		        name="pages[]"
		        :value="id">
		    <div class="pull-right pageslists--save-button">
		        {!! Form::submit("Guardar orden", [
		            'class' => 'btn waves-effect waves-light',
		            'form'  => 'sort_page_sections_form'
		        ]) !!}
		    </div>
		{!! Form::close() !!}

	</div>
</template>
