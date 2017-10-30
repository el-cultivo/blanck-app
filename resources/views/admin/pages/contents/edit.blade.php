@extends('layouts.admin')


@section('title')
    {!! trans('manage_pages.contents.edit.label') !!} |
@endsection

@section('h1')
    {!! trans('manage_pages.contents.edit.label') !!}
@endsection


@section('action')
    <a href="{{ route( 'admin::pages.contents.index' ) }}" class="btn-floating">
        <i class="material-icons waves-effect waves-light " >view_list</i>
    </a>
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  '',
        'instructions'  =>  trans('manage_pages.contents.edit.instructions' ,["page" => $page_edit->index] )
    ])

    @include('admin.pages._basic-info-form',[
        "form_id"       => 'edit_page_contents_form',
        "form_route"   => ['admin::pages.contents.update',$page_edit->id],
        "form_method"   => 'PATCH'
    ])

    <current-page-sections :list="store.current_page.sections_maped" :current-page="store.current_page"></current-page-sections-checkbox>

@endsection

@section('modals')
        <media-manager v-ref:media_manager></media-manager>
@endsection

@section('vue_templates')
    <template id="current-page-sections-template">
        <div class="">
            <div class="" v-if="list.length > 0" >

                <div class="col s12 ">
                    <div class="divider" ></div>
                </div>

                {{-- @include('admin.general._page-subtitle', [
                    'title'         =>  'Secciones',
                ]) --}}

                <component
                    :is='"section-"+section.type.admin_view_path'
                    v-for="section in list"
                    :section="section"
                    :list= "section.components"
                    :index="$index"
                ></component>

            </div>
        </div>

    </template>
    @include('admin.media_manager.vue.multi-images-template')
    @include('admin.media_manager.vue._modal-media_manager')
    @include('admin.media_manager.vue.single-image-template')
    @include('admin.pages.contents.templates.protected')
    @include('admin.pages.contents.templates.multiple-unlimited')
    @include('admin.pages.contents.templates.multiple-limited')
    @include('admin.pages.contents.templates.multiple-fixed')
    @include('admin.pages.contents.templates._component-form')
@endsection

@section('vue_store')
    <script>
        mainVueStore.current_page = {!! $page_edit !!};
    </script>
@endsection
