<div class="image__col--@{{type}} image__col camera-blue handle singleImage--@{{printable_ref}}_JS" :data-id="image.id">
	<slot name="title"></slot>
	<slot name="description"></slot>
	<div class="image--@{{type}}">
		<div class="image--@{{type}}__aspect-ratio-container h-inherit w-inherit flex">
			<div class="image__inline-block-container" v-bind:class="{
				'h-100': !image.src,
				'w-100': !image.src
			}">
				<div  v-on:click="initAddMediaProcess(media_manager, $event)">
					<slot name="data"></slot>
					<div v-if="image.src" class="image__image-remove">
						{!! Form::open([
							'method'             => 'DELETE',
							'route'             => ['admin::photos.ajax.disassociate', '&#123;&#123;image.id&#125;&#125;'],
							'role'               => 'form' ,
							'id'                 => 'disassociate_photos-&#123;&#123;printable_ref&#125;&#125;_form',
							'v-on:submit.prevent'  => 'post',
							'data-index' => '&#123;&#123;printable_ref&#125;&#125;'
						]) !!}
							{!! Form::hidden("photo_id", null, [
								'required' => 'required',
								'form'     => 'disassociate_photos-&#123;&#123;printable_ref&#125;&#125;_form',
								'v-model' => 'image.id'
							]) !!}
							{!! Form::hidden("photoable_id", null, [
								'required' => 'required',
								'form'     => 'disassociate_photos-&#123;&#123;printable_ref&#125;&#125;_form',
								'v-model' => 'photoableId'
							]) !!}
							{!! Form::hidden("photoable_type", null, [
								'required' => 'required',
								'form'     => 'disassociate_photos-&#123;&#123;printable_ref&#125;&#125;_form',
								'v-model' => 'photoableType'
							]) !!}
							{!! Form::hidden("use", null, [
								'required' => 'required',
								'form'     => 'disassociate_photos-&#123;&#123;printable_ref&#125;&#125;_form',
								'v-model' => 'use'
							]) !!}
							{!! Form::hidden("class", null, [
								'required' => 'required',
								'form'     => 'disassociate_photos-&#123;&#123;printable_ref&#125;&#125;_form',
								'v-model' => 'class'
							]) !!}
							{!! Form::hidden("order", null, [
								'required' => 'required',
								'form'     => 'disassociate_photos-&#123;&#123;printable_ref&#125;&#125;_form',
								'v-model' => 'order'
							]) !!}
								<button form="disassociate_photos-&#123;&#123;printable_ref&#125;&#125;_form" class=" btn-floating waves-effect waves-light deep-orange image__image-remove--button" type="submit">
									<i class="material-icons image__image-remove--button-icon">&#xE15B;</i>
								</button>
						{!! Form::close() !!}
					</div>
					<div  v-if="!image.src" class="image__icon-container">
						<div class="media-manager--trigger">
							<span class="fa fa-camera media-manager__icon-camera"></span>
							<span class="media-manager__icon-camera media-manager__icon-camera--add">Agregar</span>
						</div>
					</div>
					<img  v-else class="image" v-bind:src="image.src" data-id="@{{image.id}}">
				</div>
				<div v-if="image.src">
					<slot name="permutation-arrows"></slot>
				</div>
				<slot name="remove" v-if="!image.src"></slot>

			</div>
		</div>
	</div>
	<div>
		<slot name="size"></slot>
	</div>
</div>
