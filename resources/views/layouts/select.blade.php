<script  type="x/templates" id="{{ $select_plural }}-select-template">
	<div class="input-field">

		{!! Form::label($select_id, $select_label, [
			'class' => 'input-label active select--label'
		]) !!}

		<select class="validate select--item"

				@if (empty($form_id))
					:form="form_id"
				@else
					form='{{ $form_id }}'
				@endif

				name="{{ $select_id }}"
				id="{{ $select_id }}"
				@if ( isset($model) && $model )
					v-model="{{ $model }}.{{ $select_id }}"
				@endif
				@if ( isset($required) && $required )
					required="required"
				@endif
				>
			<option value="{{ isset($default_value) ? $default_value : '' }}" disabled>{{ isset($default_label) ? $default_label : 'Seleccionar' }}</option>
			<option :value="item.{{ $option_value }}" v-for="item in list">&#123;&#123; item.{{ $option_label }} &#125;&#125;</option>
		</select>

		<a data-target="{{ $select_plural }}-modal-create" class="modal-trigger select--modal-trigger">@yield( 'modal-label' )</a>

	</div>
</script>
