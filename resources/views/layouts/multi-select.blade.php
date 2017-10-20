<script type="x/templates" id="{{$select_plural}}-multi-select-template">

	{!! Form::open([
	   'method'             => $form_method,
	   'route'              => $form_route,
	   'role'               => 'form' ,
	   'id'                 => $form_id,
	   'class'              => '',
	   'v-on:submit.prevent'   => 'post'
	 ]) !!}
		 <label class="label">@yield('select-title')</label>
		 <div class="submenu submenu_JS" v-on:click="openMultiSelect()" style="position: relative">
			 <div class="select-wrapper"><span class="select" contenteditable="false" placeholder="Elige una opción">@{{ labels }}</span><span class="caret">▼</span></div>


			 <!-- opciones del select -->
			 <div class="submenu-container container-items_JS" >
				 <div class="container-item" v-for="item in list">
			         <input
			             type="checkbox"
			             name="{{ $select_plural }}[]"
						 :id="'{{$select_plural}}'+'_'+item.{{ $option_value }}"
			             :value="item.{{ $option_value }}"
			             :checked = "is_checked(item.{{ $option_value }})"
			             v-model="checkedItems"
						 form = "{{ $form_id }}"
			         >
			         <label :for="'{{$select_plural}}_'+item.{{ $option_value }}">&#123;&#123; item.{{ $option_label }} &#125;&#125;</label>
			     </div>
			 </div>
		 </div>

		 @if (isset($add_label) && !empty($add_label) )
		 <div class="">
		 <a class="modal-trigger select--modal-trigger right" data-target="{{$select_plural}}-modal-create">
			 {{$add_label}}
		 </a>
		 </div>
		 @endif


		<div class="">
		<br><br><br>
            <div class="pull-right">
                {!! Form::submit(trans('admin.form.save') , [
                    'class' => 'btn waves-effect waves-light btn-creel flex-collapsible ',
                    'form'  => $form_id
                ]) !!}
            </div>
        </div>
	{!! Form::close() !!}

</script>
