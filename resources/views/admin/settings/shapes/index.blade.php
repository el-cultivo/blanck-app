@extends('layouts.admin')


@section('title')
    Shapes
@endsection

@section('h1')
    Shapes
@endsection


@section('content')

    @foreach ($shapes_by_page as $page_slug => $shapes)
        <div class="col s10 offset-s1">
                <h5>{{ trans('manage_shapes.'.$page_slug.'.title') }}</h5>

                <div class="row">
                    @foreach ($shapes as $key => $shape)
                    <div class="col s4 ">
                        <div class="card">
                          <div class="card-image">
                            {{-- <img src="{{asset("images/box.jpg")}}"> --}}
                            <single-image
                                :ref-path='shape_{{$shape->id}}'
                                :current-image="{{json_encode($shape->thumbnail_image)}}"
                                type="setting_shape"
                                :photoable-id="{{$shape->id}}"
                                photoable-type="setting_shape"
                                use="thumbnail"
                                class=""
                                default-order="null"
                            ></single-image>
                            {{-- <span class="card-title">{{ trans('manage_shapes.'.$page_slug.'.'.$shape->key.'.title') }}</span> --}}
                          </div>
                          <div class="card-content">
                            <p>{{ trans('manage_shapes.'.$page_slug.'.'.$shape->key.'.title') }}</p>
                          </div>
                        </div>
                      </div>
                    @endforeach

                </div>

        </div>
        <div class="col s10 offset-s1">
            <br> <div class="divider"></div>
        </div>
    @endforeach
@endsection


@section('modals')
        <media-manager v-ref:media_manager></media-manager>
@endsection

@section('vue_templates')
    @include('admin.media_manager.vue.multi-images-template')
    @include('admin.media_manager.vue._modal-media_manager')
    @include('admin.media_manager.vue.single-image-template')
@endsection
