# single-image.js

El componente **singleImage** puede ser usado en CURDs en los que solo se require agregar una imágen y no se necesita pasar más información del objeto, que la que se use para lidiar con el **mediaManager**.

### Pasos

1 . Registrar el **singleImage** en el componente o la instancia padre i.e. en el mainVue en micorriza-admin.js (el mediaManager siempre debe estar registrado en la instancia principal, es decir en micorriza-admin.js)
Ignorar el tag de script, sólo son para agregar colores

```js
//micorriza-admin.js
ifElementExistsThenLaunch([
	['#admin-vue', mainVue, undefined, [{}, {
		mediaManager,
		singleImage, ...}]],
	[...]
]);
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

3 . Agregar el single-image donde se necesite... es necesario pasar el photoable-id para que se abra el mediaManager

```html
<single-image
	v-ref:"ally" //referencia en la instancia de vue
	:current-image="store.current_ally.thumbnail_image" //imágen previamente cargada que ha sido recibida de la base de datos

	//cosas que necesita la base para salvar
	type="allies"
	photoable-id="{{$ally->id}}"
	photoable-type="ally"
	use="thumbnail"
	class=""
	default-order="null" //por lo general se usa null pasándolo como string. Si se omite este atributo, el componente manda 0
></single-image>
```
