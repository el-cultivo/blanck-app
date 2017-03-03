# multi-images.js

`for: version 2.0.0-BestBuddies`

El componente **&lt;multiImages&gt;** puede ser usado en CRUDs en los que se require una galería cuyas imágenes puedan ordenarse mediante drag and drop.  Este componente require de la presencia del **&lt;mediaManager&gt;** como hijo directo de la instancia **&lt;Root&gt;** de Vue.


### Pasos

1 . Registros: Registar el  **&lt;multiImages&gt;** en el componente o la instancia padre i.e. en el `mainVue` en `micorriza-admin.js` (el `mediaManager` siempre debe estar registrado en la instancia principal, es decir en micorriza-admin.js)

```js
//micorriza-admin.js
ifElementExistsThenLaunch([
	['#admin-vue', mainVue, undefined, [{}, {
		mediaManager,
		multiImages, ...}]],
	[...]
]);
```

2 . Templates: Agregar a la vista donde se requiera los templates del `multi-images` y del `media-manager`
```
{-- alguna-vista.blade.php --}

	@extends('layouts.admin')

	@section('vue_templates')
		@include('admin.media_manager.vue.multi-images')
		@include('admin.media_manager.vue._modal-media-manager-template')
	@endsection
```

3 . Crear galería: Agregar el tag de `<multi-images></multi-images>` donde se necesite.

3.1 Atributos:
* **v-ref:<algo>** es muy necesario y debe ser único.
* **:all-photos** path a la lista de todas las fotos del post. Se corre en el momento de la carga, para mostrar las imágenes ya asociadas.
* **use** debe ser gallery o algun otro uso registrado para galerías en los Modelos de `Post` o `Page` o `X` en el Backend
* **photoable-id** es necesario para que se abra el mediaManager)
* **photoable-type** a dónde pertence la imágen
* **default-order** siempre debe ser el el `string` `null`

```html
<multi-images
	v-ref:gallery
	:all-photos="store.current_post.photos"
	photoable-id="{{$post->id}}"
	photoable-type="post"
	default-order="null"
	use='gallery'
></multi-images>
```
