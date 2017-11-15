<div class="col s12">
    <div class="divider"></div>
</div>
<div class="col s10 offset-s1">
    <div class="row">
        <h6 class=""><b>Seo Booster</b></h6>
        <div class="col s12" style="margin-top: 20px; margin-bottom: 30px;">
            <label for="">{{ trans('manage_seo.edit.route') }}:</label>
            <a href="{{ $seo->uri }}" target="_blank">{{ $seo->uri }}</a>
        </div>
        <div class="col s2">
            <single-image
                :ref-path="['seo']"
                :current-image="store.seo.thumbnail_image"
                :photoable-id="store.seo.id"
                photoable-type="seo"
                default-order="null"
                use='thumbnail'
            ></single-image>
        </div>
        <div class="col s10">
            {!! Form::open([
                'method'                => 'PATCH',
                'route'                 => ['admin::seo.update', $seo],
                'role'                  => 'form',
                'id'                    => 'update_seo_form',
                'class'                 => '',
            ]) !!}
                @foreach ($languages as $language)
                    {!! Form::label('title[' . $language->iso6391 . ']', trans('manage_seo.title'), ['class' => 'active']) !!}
                    <input type="text" name="title[{{ $language->iso6391 }}]" id="title[{{ $language->iso6391 }}]" value="{{ $seo->translation($language->iso6391)->title }}" form="update_seo_form">
                    {!! Form::label('description[' . $language->iso6391 . ']', trans('manage_seo.description'), ['class' => 'active']) !!}
                    <textarea name="description[{{ $language->iso6391 }}]" id="description[{{ $language->iso6391 }}]" cols="30" rows="10" form="update_seo_form">{{ $seo->translation($language->iso6391)->description }}</textarea>
                    <input type="hidden" name="seoable_type" value="{{ $seoable_type }}" form="update_seo_form">
                    <input type="hidden" name="seoable_id" value="{{ $seoable->id }}" form="update_seo_form">
                    <br><br>
                    @include('admin.seo._googleSearchResults', [
                        'seo' => $seo,
                        'lang' => $language
                    ])
                @endforeach
                <div class="pull-right">
                    {!! Form::submit(trans('manage_pages.create.form.save'), [
                        'class' => 'btn waves-effect waves-light flex-collapsible',
                        'form' => 'update_seo_form'
                    ]) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
