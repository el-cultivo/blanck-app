<div class="row" v-if="filterableAndSortablePhotos.length > 0">
    <div 
        v-for="photo in filterableAndSortablePhotos"
        class="undraggable media-manager__img-container"
        v-bind:class="{
            'col s2': chosen_img.src === '',
            'col s3': chosen_img.src !== ''
        }"
        v-on:click="onChosenImage($event)"
    >
        {{-- <img src="@{{photo.thumbnail_url}}"> --}}
        <div
        	data-image-url="@{{photo.thumbnail_url}}"
        	data-id="@{{photo.id}}"
        	data-index="@{{$index}}"
        	class="transition-slow hover-scale-up undraggable media-manager__img-container--position"
        	v-bind:style="{backgroundImage: 'url(' + photo.thumbnail_url +')', height : 100 + '%'}">
        </div>
    </div>
</div>
<div class="row" v-else><h5>Recuperando imágenes...</h5></div>
