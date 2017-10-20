<table class="highlight responsive-table  sections__table">
	<thead class="sections__table__head">
		<tr>
			<th class="sections__table--nombre">{!!trans('manage_pages.sections.index.table.name')!!}</th>
			<th class="sections__table--tipo">{!!trans('manage_pages.sections.index.table.type')!!}</th>
			<th class="sections__table--direccion">{!!trans('manage_pages.sections.index.table.template')!!}</th>
			<th class="sections__table--direccion">{!!trans('manage_pages.sections.index.table.pages')!!}</th>
			<th class="center-align sections__table--editar" >{!!trans('manage_pages.sections.index.table.edit')!!}</th>
			<th class="center-align sections__table--desactivar" >{!!trans('manage_pages.sections.index.table.delite')!!}</th>
		</tr>
	</thead>

	<tbody class="sections__table__body">
		<tr class="sections__table__row" v-for="section in list" >
			<td class="sections__table--nombre">
				@{{ section.index }}
				<small>
					<br>
					@{{{ section.description }}}
				</small>
			</td>
			<td class="sections__table--tipo">
				@{{{ section.type_label }}}
			</td>
			<td class="sections__table--direccion">
				@{{ section.template_path }}
				<br>
				<small>
					@{{{ section.implode_editable_contents }}}
				</small>
			</td>
			<td class="sections__table--direccion">
				@{{{ section.implode_pages_index }}}
			</td>
			<td class="center-align sections__table--editar">
				<span
					class=" btn-floating waves-effect waves-light"
					@click="openModal('#pagesections-modal-edit' ,$index)">
					<i class="material-icons waves-effect waves-light " >mode_edit</i>
				</span>
			</td>
			<td class="center-align sections__table--desactivar">
				{!! Form::open([
					'method'				=> 'DELETE',
					'route'					=> ['admin::pages.sections.ajax.destroy','&#123;&#123;section.id&#125;&#125;'],
					'role'					=> 'form' ,
					'id'					=> 'delete_section-&#123;&#123;section.id&#125;&#125;_form',
					'class'					=> '',
					'data-index'			=> '&#123;&#123;$index&#125;&#125;',
					'v-on:submit.prevent'	=> 'post'
				]) !!}

					<button type="submit" class=" btn-floating waves-effect waves-light deep-orange accent-2" form ="delete_section-&#123;&#123; section.id &#125;&#125;_form">
						<i class="material-icons">delete</i>
					</button>

				{!!Form::close()!!}
			</td>
		</tr>
	</tbody>
</table>
