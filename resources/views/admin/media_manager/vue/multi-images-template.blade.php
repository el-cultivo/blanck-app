<template id="multi-images-template">
	<div>

		<div class="row mb-5">
			<div class="col s12">
				<h5 class=""  v-text = ' title ? title : "{{trans('manage_photo.title')}}" '></h5>
			</div>
		</div>

		<div class="">
			<div class="row" >
				<div class="" v-sortable="{onUpdate: onUpdate, onMove: onMove, group: label}">
					<div v-for="image in images" class='multiimages-image' style="width: 25%;float: left; margin-bottom: 5%;">
						<single-image
							:ref-path="refPath.concat($index)"
							:index="$index"
							:parent-ref="ref"
							:type="type"
							:photoable-id="photoableId"
							:photoable-type="photoableType"
							:use="use"
							:class="class"
							:current-image="image"
							:default-order="defaultOrder"
							>
							<div slot="remove" style="margin-top: 5%; cursor: pointer;">
								<a class="button__as-link" v-on:click.stop="remove($index)">{{trans('manage_photo.button.remove')}}</a>
							</div>
						</single-image>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col s10 ">
				<div class="pull-left btn" v-on:click="addSingleImageComponent">
					<span class="icon-plus fa fa-plus"></span>
					<span class="icon-text-plus">{{trans('manage_photo.button.add')}}</span>
				</div>
			</div>
		</div>

		{!! Form::open([
			'method' => 'PATCH',
			'route' => ['admin::photos.ajax.sort'],
			'role' => 'form' ,
			':id' => " 'sort-multi-images_'+printable_ref+'_form' ",
			'class'	=> '',
			'v-on:submit.prevent'	=> 'postOrders'
			]) !!}

			{!! Form::submit(trans('manage_photo.create.form.save'), ['style' => 'margin-bottom: 10%;', 'class' => 'btn btn-primary button pull-right', ':form'=> "'sort-multi-images_'+printable_ref+'_form'"]) !!}

			    <input type="hidden" :form="'sort-multi-images_'+printable_ref+'_form'" name="photos[]" :value="id" v-for="id in ordered_ids">

			{!! Form::hidden("class", null, [
				'required' => 'required',
				':form' => " 'sort-multi-images_'+printable_ref+'_form' ",
				'v-model' => 'class'
				]) !!}
			{!! Form::hidden("use", null, [
				'required' => 'required',
				':form'	 => " 'sort-multi-images_'+printable_ref+'_form' ",
				'v-model' =>  'use'
				]) !!}
			{!! Form::hidden("photoable_type", null, [
				'required' => 'required',
				':form' => " 'sort-multi-images_'+printable_ref+'_form' ",
				'v-model' =>  'photoableType'
				]) !!}
			{!! Form::hidden("photoable_id", null, [
				'required' => 'required',
				':form' => " 'sort-multi-images_'+printable_ref+'_form' ",
				'v-model' =>  'photoableId'
				]) !!}
		{!! Form::close()!!}

	</div>
</template>
