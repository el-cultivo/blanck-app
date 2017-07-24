<div id="media-update_JS" class="media-manager__manage-img-details" v-bind:class="{
		'media-manager__manage-img-details--image-is-selected': chosen_img.src !== ''
	}"> {{-- media-manager__manage-img-details--image-is-selected --}}
	<div class="row">
		<div class="right media-manager__back" id="close-update_JS" style="display:none;">&#10005;</div>
		<div class="col s5">
			<img v-bind:src="chosen_img.src">
		</div>

		<div class="col s7">
			<span class="media-manager__text">@{{chosen_img.es_title}}</span>
			<span class="media-manager__text media-manager__text--info" v-if="chosen_img.created_at">Creada en: @{{chosen_img.created_at}}</span>
			{{-- <span class="media-manager__text media-manager__text--info">650 kB</span>
			<span class="media-manager__text media-manager__text--info">400 x 683</span> --}}

			{!! Form::open([
				'method'	=> 'delete',
				'class'	 => '',
				'route'	=> ['admin::photos.ajax.destroy','&#123;&#123;chosen_img.id&#125;&#125;'],
				'role'				  => 'form',
				'id'					=> 'delete_photo_form',
				'v-on:submit.prevent'   => 'post'
				]) !!}

					{!! Form::submit("Borrar permanentemente", ['class' => 'media-manager__link']) !!}

			{!! Form::close() !!}

		</div>
	</div>

	<div class="row">
		<div class="col s12">
			<div class="divider"></div>
		</div>
	</div>

	{!! Form::open([
		'method'	=> 'patch',
		'class'	 => 'row',
		'route'	=> ['admin::photos.ajax.update','&#123;&#123;chosen_img.id&#125;&#125;'],
		'role'				  => 'form',
		'id'					=> 'update_photo_form',
		'v-on:submit.prevent'   => 'post'
		]) !!}

		<div class="col s12">
			<div class="row">
				<div class="col s12">
					<span class="text">Título</span>
				</div>

				@foreach ($languages as $language)
					<div class="col s12 media-manager__col-form ">
						{!! Form::text('title['.$language->iso6391.']', '', [
							'class' => 'form-control input-sm input',
							// 'required' => 'required',
							'form'  => 'update_photo_form',
							'v-model' => 'chosen_img.'.$language->iso6391.'_title',
							'placeholder'   => $language->label
						]) !!}
					</div>
				@endforeach
			</div>

			<div class="row">
				<div class="col s12">
					<span class="text">Texto alternativo</span>
				</div>

				@foreach ($languages as $language)
					<div class="col s12 media-manager__col-form ">
						{!! Form::text('alt['.$language->iso6391.']', '', [
							'class' => 'form-control input-sm input',
							'required' => 'required',
							'form'  => 'update_photo_form',
							'v-model' => 'chosen_img.'.$language->iso6391.'_alt',
							'placeholder'   => $language->label
						]) !!}
					</div>
				@endforeach
			</div>

			<div class="row">
				<div class="col s12">
					<span class="text">Descripción</span>
				</div>

				@foreach ($languages as $language)
					<div class="col s12 media-manager__col-form ">
						{!! Form::textarea('description['.$language->iso6391.']', '', [
							'class' => 'form-control input materialize-textarea',
							// 'required' => 'required',
							'form'  => 'update_photo_form',
							'rows' => '2',
							'v-model'	=>  'chosen_img.'.$language->iso6391.'_description',
							'placeholder'   => $language->label
						]) !!}
					</div>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				<div class="divider"></div>
			</div>
		</div>
		
		<div class="col s6 center-align">
			{!! Form::submit('guardar', [
				'class' => 'btn btn-primary input-sm input input__submit',
				'form'  => 'update_photo_form'
			]) !!}
		</div>
	{!! Form::close() !!}
		<div class="col s6 center-align right media-manager__manage--seleccionar">
			@include('admin.media_manager.partials._select-image-form')
		</div>



</div>
