@extends('layouts.admin')


@section('title')
    {!! trans('manage_pages.contents.index.label') !!}
@endsection

@section('h1')
    {!! trans('manage_pages.contents.index.label') !!}
@endsection

@section('content')
    <pages :list="store.page_groups.data"></pages>
@endsection


@section('vue_templates')
    <template id="pages-template">
        <div class="">
            @include('admin.general._page-instructions', [
                'title'         =>  '',
                'instructions'  =>  trans('manage_pages.contents.index.instructions')
            ])
            <div class="col s10 offset-s1">
                <div v-for="pages_group in list" track-by="$index">
                    <h5>@{{{pages_group.parent_label}}}</h5>
                    <pages-group :list="pages_group.pages" :index="pages_group.parent_index" :label="pages_group.parent_label"></pages-group>
                </div>
            </div>
        </div>
    </template>
    @include('admin.pages.contents.index._table-row')
@endsection

@section('vue_store')
	<script>
		mainVueStore.page_groups = { data: {!! $pages_groups !!} };
	</script>
@endsection
