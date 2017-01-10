@extends('layouts.admin',['media_manager' => true])


@section('title')
    Media Manager |
@endsection

@section('h1')
    Media Manager
@endsection



@section('content')
<h4>Single Image</h4>
    <single-image></single-image>
    <single-image
        v-ref:"prueba"
        current-image=""
        type="single"
        photoable-id="0"
        photoable-type="0"
        use="media_manager"
        class=""
        order=""
        >
        <h5 slot="title" class="text__p text__p--garments-sm">titulo</h5>
        @include('admin.media_manager.vue._image-placeholder-slot')
    </single-image>

    <div class="col s10 offset-s1">
        <div class="row">
            @include('admin.media_manager.index._trigger')
            @foreach ($photos as $photo)
                @include('admin.media_manager.index._image')
            @endforeach
        </div>
    </div>

@endsection

@section('modals')
    @include('admin.general._modal')
    {{-- @include('admin.general._modal2') --}}
@endsection

@section('vue_templates')
    @include('admin.media_manager.vue.mediaManager-template')
    @include('admin.media_manager.vue.single-image-template')
@endsection
