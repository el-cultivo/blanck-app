<template id="multi-images-template">
		<div>
				<div class="row">
						<div class="col-xs-10">
								<p class="text__p">Otras:</p>
						</div>
				</div>
				<div class="garments__other-img-container">
						<div class="row garments__other-img_JS" >
								<div class="garments__other-single-image">
										<single-image
												v-ref:other-images-list
												:index="$index"
												:parent-ref="ref"
												:type="type"
												:photoable-id="photoableId"
												:photoable-type="photoableType"
												:use="use"
												:class="class"
												:current-image="image"
												v-for="image in images">
												@include('admin.modules.general._image-placeholder-slot')
												<div slot="permutation-arrows" class="garments__permutation-arrow-container">
														<a class="garments__permutation-arrow
																			garments__permutation-arrow--up
																			fa fa-chevron-up"
																			v-on:click="sort(-2, $index, $event)"></a>
														<a class="garments__permutation-arrow
																			garments__permutation-arrow--down
																			fa fa-chevron-down"
																			v-on:click="sort(2, $index, $event)"></a>
														<a class="garments__permutation-arrow
																			garments__permutation-arrow--left
																			fa fa-chevron-left"
																			v-on:click="sort(-1, $index, $event)"></a>
														<a class="garments__permutation-arrow
																			garments__permutation-arrow--right
																			fa fa-chevron-right"
																			v-on:click="sort(1, $index, $event)"></a>
												</div>
												<div slot="remove">
														<a class="button__as-link" v-on:click="remove($index)">Remover</a>
												</div>
										</single-image>
								</div>
						</div>
				</div>
				<div class="row">
						<div class="col-xs-10 garments__icon-container">
							<div class="garments__icon-positioner" v-on:click="addSingleImageComponent">
									<span class="icon-plus fa fa-plus"></span>
									<span class="icon-text-plus">Agregar</span>
							</div>
						</div>
				</div>

				{!! Form::open([
						'method'								=> 'PATCH',
						'route'								=> ['admin::photos.ajax.sort'],
						'role'									=> 'form' ,
						'id'										=> 'sort_garment-gender-&#123;&#123; ref &#125;&#125;_form',
						'class'								 => '',
						'v-on:submit.prevent'		=>	'post'
				]) !!}
						{!! Form::submit('Guardar Orden', ['class' => 'btn btn-primary button', 'form'=> "sort_garment-gender-&#123;&#123; ref &#125;&#125;_form"]) !!}

						{!! Form::hidden("photos[]", '&#123;&#123; children_with_image_order[$index] &#125;&#125;', [
							 'required' => 'required',
							 'form'		 => 'sort_garment-gender-&#123;&#123; ref &#125;&#125;_form',
							 'v-for' => 'children in children_with_image_order'
						]) !!}
						{!! Form::hidden("class", null, [
							 'required' => 'required',
							 'form'		 => 'sort_garment-gender-&#123;&#123; ref &#125;&#125;_form',
							 'v-model' => 'class'
						]) !!}
						{!! Form::hidden("use", null, [
							 'required' => 'required',
							 'form'		 => 'sort_garment-gender-&#123;&#123; ref &#125;&#125;_form',
							 'v-model'		=>		 'use'
						]) !!}
						{!! Form::hidden("photoable_type", null, [
							 'required' => 'required',
							 'form'		 => 'sort_garment-gender-&#123;&#123; ref &#125;&#125;_form',
							 'v-model'		=>		 'photoableType'
						]) !!}
						{!! Form::hidden("photoable_id", null, [
							 'required' => 'required',
							 'form'		 => 'sort_garment-gender-&#123;&#123; ref &#125;&#125;_form',
							 'v-model'		=>		 'photoableId'
						]) !!}
				{!! Form::close()!!}
		</div>
</template>
