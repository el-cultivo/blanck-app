# sime-crud-component-makers.js

## simpleCrudWithImage
Este componente puede ser usado cuando se tiene un array de objetos, cada uno de los cuales tiene o tendrá una imágen asociada.


### Pasos
1 . Registrar el Crud y agregarlo como componente al padre en simple-cruds.js

```js
export const registrationtypesRow = simpleCrudWithImage('#registrationtypes-row-template', {props:['registrationtype']});//este prop recibirá el objeto individual de la lista
export const registrationtypes = simpleCrud('#registrationtypes-template', {components:{registrationtypesRow, ...}, ...});
```

2 . Crear el template
```html
<template id="registrationtypes-row-template">
	<tr class="">
		<td class="" >
			@include('admin.media_manager.vue.vue-image')//aqui va la imágen.
		</td>
		<td class="" >
			@{{registrationtype.label}}
		</td>
		<td class="" >
			@{{registrationtype.description}}
		</td>
		<...></...>
	</tr>
</template>
```
3 . Agregar el template, el media-manager a la vista donde se encuentra la tabla y pasar la variable al layout $media_manager
```


{-- alguna-vista.blade.php --}

	@extends('layouts.admin',['media_manager' => true])

	@section('vue_templates')
		@include('admin.registrations.registrationtypes.registration-types-row-template')
		@include('admin.media_manager.vue.mediaManager-template')
	@endsection
```

4 . Si es una tabla, como se asume en el punto 2, crear un row... éste acepta la lista y hace el loop de la lista compelta. Ojo con el atributp "registrationtype", que acepta el objeto producido por el v-for y el "ref-path" que apunta desde la isntancia de Vue hasta el indice de la lista que pertenece a el objeto que pasamos (y sirve para actualizarlo)

```html
<!-- Aquí usamos el atributo is puesto que estamos usando una tabla, de los contrario sería un componente ordinario: <registrationtypes-row></registrationtypes-row> -->
<table>
	<tbody>
		<tr is="registrationtypes-row"
			v-for="registrationtype in list"
			:index="$index"
			:list.sync="list"
			:registrationtype="registrationtype"
			v-ref:list
			:ref-path="['$root', '$refs', 'registrationtypes', '$refs', 'list', $index]"// referencia desde la instancia principal de vue (i.e. mainVue) hasta el objeto particular
			:current-image="registrationtype.thumbnail_image"
			:photoable-id="registrationtype.id"
			:photoable-type="'registrationtype'"
			:use="'thumbnail'"
			:class="''"
			:default-order="'null'"
		></tr>
	</tbody>
</table>
```
5 . En la vista registrar el v-ref del componente padre, para que el mediaManager conozca el path hacia dónde asociará la imágen
```html
<!-- El template que contiene la tabla -->
<registrationtypes
	:list="store.registrationtypes.data"
	v-ref:registrationtypes
></registrationtypes>
```
