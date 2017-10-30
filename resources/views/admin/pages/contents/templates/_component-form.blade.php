<template id="component-form-template">

    <div class="row">
        <div class="col s12" v-if="section.editable_contents.gallery_img">
                <multi-images
                    :ref-path='[component.id, "gallery", index]'
                    :all-photos="component.gallery_images"
                    :photoable-id="component.id"
                    photoable-type="page_component"
                    default-order="null"
                    use='gallery'
                ></multi-images>
        </div>

        {!! Form::open([
            'method'                => "PATCH",
            'route'                 => ['admin::pages.sections.ajax.components.update','&#123;&#123;section.id&#125;&#125;','&#123;&#123;component.id&#125;&#125;'],
            'role'                  => 'form' ,
            'id'                    => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;',
            'v-on:submit.prevent'   => 'post',
            ]) !!}

            <div class="col s4" v-if="section.editable_contents.thumbnail_img">

                <single-image
                    :ref-path='[component.id, "single-image", index]'
                    :current-image="component.thumbnail_image"
                    type="page_component"
                    :photoable-id="component.id"
                    photoable-type="page_component"
                    use="thumbnail"
                    class=""
                    default-order="null"
                ></single-image>

            </div>
            <div class="col " v-bind:class="{ s8: section.editable_contents.thumbnail_img, s12: !section.editable_contents.thumbnail_img  }">

                @foreach($languages as $language)
                    <div class="input-field" v-if="section.editable_contents.title">
                        {!! Form::label("title[".$language->iso6391."]", trans('manage_pages.contents.components.form.title.label', ["language" => $language->label]), ['class' => 'input-label active no-top']) !!}
                        {!! Form::text("title[".$language->iso6391."]", null, [
                            'class'       => 'validate',
                            'placeholder' => trans('manage_pages.contents.components.form.title.placeholder', ["language" => $language->label]),
                            // 'required'    => 'required',
                            'v-model'     => 'component.'.$language->iso6391.'_title',
                            'form'        => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;'
                        ]) !!}
                    </div>
                @endforeach

            </div>
            <div class="col s12" >

                @foreach($languages as $language)
                    <div class="input-field mt-5" v-if="section.editable_contents.subtitle">
                        {!! Form::label("subtitle[".$language->iso6391."]", trans('manage_pages.contents.components.form.subtitle.label', ["language" => $language->label]), ['class' => 'input-label active no-top']) !!}
                        {!! Form::text("subtitle[".$language->iso6391."]", null, [
                            'class'       => 'validate',
                            'placeholder' => trans('manage_pages.contents.components.form.subtitle.placeholder', ["language" => $language->label]),
                            // 'required'    => 'required',
                            'v-model'     => 'component.'.$language->iso6391.'_subtitle',
                            'form'        => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;'
                        ]) !!}
                    </div>
                @endforeach

            </div>

            <div class="col s12" v-if="section.editable_contents.excerpt">

                @foreach($languages as $language)
                    <div class="input-field mt-5" v-if="section.editable_contents.excerpt">
                        {!! Form::label("excerpt[".$language->iso6391."]", trans('manage_pages.contents.components.form.excerpt.label', ["language" => $language->label]), ['class' => 'input-label active no-top']) !!}

                        <v-editor :content.sync='component.{{ $language->iso6391 }}_excerpt '></v-editor>
                        <input type="hidden" v-model="component.{{ $language->iso6391 }}_excerpt" name="excerpt[{{ $language->iso6391 }}]">
                    </div>
                @endforeach

            </div>

            <div class="col s12" v-if="section.editable_contents.content">

                @foreach($languages as $language)
                    <div class="input-field mt-5" v-if="section.editable_contents.content">
                        {!! Form::label("content[".$language->iso6391."]", trans('manage_pages.contents.components.form.content.label', ["language" => $language->label]) , ['class' => 'input-label active no-top']) !!}

                        <v-editor :content.sync='component.{{ $language->iso6391 }}_content'></v-editor>
                        <input type="hidden" v-model="component.{{ $language->iso6391 }}_content" name="content[{{ $language->iso6391 }}]">
                    </div>
                @endforeach

            </div>


            <div class="col s12" v-if="section.editable_contents.iframe">

                @foreach($languages as $language)
                    <div class="input-field mt-5" v-if="section.editable_contents.iframe">
                        {!! Form::label("iframe[".$language->iso6391."]", trans('manage_pages.contents.components.form.iframe.label', ["language" => $language->label]), ['class' => 'input-label active']) !!}
                        {!! Form::textarea("iframe[".$language->iso6391."]", null, [
                            'class'       => 'validate materialize-textarea',
                            'placeholder' => trans('manage_pages.contents.components.form.iframe.label', ["language" => $language->label]),
                            // 'required'    => 'required',
                            'v-model'     => 'component.'.$language->iso6391.'_iframe',
                            'form'        => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;'
                        ]) !!}
                    </div>
                @endforeach


            </div>

            <div class="" v-if="section.editable_contents.link" >

                @foreach($languages as $language)
                    <div class="input-field col s8">
                        {!! Form::label("link_title[".$language->iso6391."]",  trans('manage_pages.contents.components.form.link_title.label', ["language" => $language->label]), ['class' => 'input-label active']) !!}
                        {!! Form::text("link_title[".$language->iso6391."]", null, [
                            'class'       => 'validate',
                            'placeholder' =>  trans('manage_pages.contents.components.form.link_title.placeholder', ["language" => $language->label]),
                            // 'required'    => 'required',
                            'v-model'     => 'component.'.$language->iso6391.'_link_title',
                            'form'        => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;'
                        ]) !!}
                    </div>
                    <div class="col s4">
                        <div class="pull-right">
                            <label for="{{ '&#123;&#123;"tblank_link_'.$language->iso6391.'"+component.id&#125;&#125;' }}">
                                {!! trans('manage_pages.contents.components.form.tblank_link_.label', ["language" => $language->label]) !!}
                            </label>
                            <div class=" switch ">
                                {!! trans('manage_pages.contents.components.form.tblank_link_.no', ["language" => $language->label]) !!}
                                <label>
                                    {!! Form::checkbox("link_tblank[".$language->iso6391."]", true , null, [
                                        'class'     => 'input__checkbox',
                                        'form'      => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;',
                                        'id'        => '&#123;&#123;"tblank_link_'.$language->iso6391.'"+component.id&#125;&#125;',
                                        'v-model'   => 'component.'.$language->iso6391.'_link_tblank',
                                    ]) !!}
                                    <span class="lever"></span>
                                </label>
                                {!! trans('manage_pages.contents.components.form.tblank_link_.yes', ["language" => $language->label]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        {!! Form::label("link_url[".$language->iso6391."]", trans('manage_pages.contents.components.form.link_url.label', ["language" => $language->label]), ['class' => 'input-label active no-top']) !!}
                        {!! Form::url("link_url[".$language->iso6391."]", null, [
                            'class'       => 'validate',
                            'placeholder' => trans('manage_pages.contents.components.form.link_url.placeholder', ["language" => $language->label]),
                            // 'required'    => 'required',
                            'v-model'     => 'component.'.$language->iso6391.'_link_url',
                            'form'        => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;'
                        ]) !!}
                    </div>
                @endforeach

            </div>

            <div class="col s12 mt-5">
                <div class=" pull-right">
                    <input type="hidden" name="index" :form='"update_component_"+component.id+"_form"' v-model="componentName">
                    {!! Form::submit(trans('manage_pages.contents.components.form.save'), [
                        'class' => 'btn waves-effect waves-light',
                        'form'  => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;'
                    ]) !!}
                </div>
                <br><br>
            </div>


            </div>
        {!! Form::close() !!}
    </div>
</template>
