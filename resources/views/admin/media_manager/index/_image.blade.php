<div class="col s2 ">
  <div class="card">
      <div class="card-image">
          <img src="{{$photo->thumbnail_url }}" alt="" class=""   />
      </div>
      <div class="card-content">
          {{-- {{ dump($photo)  }} --}}
          <p>{{ $photo->es_title }}</p>
          <p>{{ $photo->es_alt }}</p>
      </div>
  </div>
</div>
