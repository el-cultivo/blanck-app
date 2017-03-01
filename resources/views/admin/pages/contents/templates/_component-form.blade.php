<template id="component-form-template">

    <div class="row">
        <div class="col s12" v-if="section.editable_contents.gallery_img">
                la galleria va aqui
        </div>

        {!! Form::open([
            'method'                => "PATCH",
            'route'                 => ['admin::pages.sections.ajax.components.update','&#123;&#123;section.id&#125;&#125;','&#123;&#123;component.id&#125;&#125;'],
            'role'                  => 'form' ,
            'id'                    => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;',
            'v-on:submit.prevent'   => 'post',
            ]) !!}

            <div class="col s4" v-if="section.editable_contents.thumbnail_img">

                thumbnail_img
                <single-image
                    v-ref:'"page_componet_thumbnail_image_"+component.id'
                    :current-image="component.thumbnail_image"
                    type="page_component"
                    :photoable-id="component.id"
                    :photoable-type="page_component"
                    use="thumbnail"
                    class=""
                    default-order="null"
                ></single-image>

            </div>
            <div class="col " v-bind:class="{ s8: section.editable_contents.thumbnail_img, s12: !section.editable_contents.thumbnail_img  }">

                @foreach($languages as $language)
                    <div class="input-field" v-if="section.editable_contents.title">
                        {!! Form::label("title[".$language->iso6391."]", 'Título ('.$language->label.'):', ['class' => 'input-label active']) !!}
                        {!! Form::text("title[".$language->iso6391."]", null, [
                            'class'       => 'validate',
                            'placeholder' => "título (".$language->label.")",
                            'required'    => 'required',
                            'v-model'     => 'component.'.$language->iso6391.'_title',
                            'form'        => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;'
                        ]) !!}
                    </div>
                @endforeach

            </div>
            <div class="col s12" >

                @foreach($languages as $language)
                    <div class="input-field" v-if="section.editable_contents.subtitle">
                        {!! Form::label("subtitle[".$language->iso6391."]", 'Subtítulo ('.$language->label.'):', ['class' => 'input-label active']) !!}
                        {!! Form::text("subtitle[".$language->iso6391."]", null, [
                            'class'       => 'validate',
                            'placeholder' => "subtítulo (".$language->label.")",
                            'required'    => 'required',
                            'v-model'     => 'component.'.$language->iso6391.'_subtitle',
                            'form'        => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;'
                        ]) !!}
                    </div>
                @endforeach

            </div>

            <div class="col s12" v-if="section.editable_contents.excerpt">

                @foreach($languages as $language)
                    <div class="input-field" v-if="section.editable_contents.excerpt">
                        {!! Form::label("excerpt[".$language->iso6391."]", 'Extracto ('.$language->label.'):', ['class' => 'input-label active']) !!}

                        <v-editor :content.sync='component.{{ $language->iso6391 }}_excerpt '></v-editor>
                        <input type="hidden" v-model="component.{{ $language->iso6391 }}_excerpt" name="excerpt[{{ $language->iso6391 }}]">
                    </div>
                @endforeach

            </div>

            <div class="col s12" v-if="section.editable_contents.content">

                @foreach($languages as $language)
                    <div class="input-field" v-if="section.editable_contents.content">
                        {!! Form::label("content[".$language->iso6391."]", 'Contentido ('.$language->label.'):', ['class' => 'input-label active']) !!}

                        <v-editor :content.sync='component.{{ $language->iso6391 }}_content'></v-editor>
                        <input type="hidden" v-model="component.{{ $language->iso6391 }}_content" name="content[{{ $language->iso6391 }}]">
                    </div>
                @endforeach

            </div>


            <div class="col s12" v-if="section.editable_contents.iframe">

                @foreach($languages as $language)
                    <div class="input-field" v-if="section.editable_contents.iframe">
                        {!! Form::label("iframe[".$language->iso6391."]", 'iframe ('.$language->label.'):', ['class' => 'input-label active']) !!}
                        {!! Form::textarea("iframe[".$language->iso6391."]", null, [
                            'class'       => 'validate materialize-textarea',
                            'placeholder' => "iframe (".$language->label.")",
                            'required'    => 'required',
                            'v-model'     => 'component.'.$language->iso6391.'_iframe',
                            'form'        => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;'
                        ]) !!}
                    </div>
                @endforeach

            </div>

            <div class="col s12" >

                @foreach($languages as $language)
                    <div class="input-field" v-if="section.editable_contents.link">
                        {!! Form::label("link[".$language->iso6391."]", 'Link ('.$language->label.'):', ['class' => 'input-label active']) !!}
                        {!! Form::url("link[".$language->iso6391."]", null, [
                            'class'       => 'validate',
                            'placeholder' => "Link (".$language->label.")",
                            'required'    => 'required',
                            'v-model'     => 'component.'.$language->iso6391.'_link',
                            'form'        => '&#123;&#123;"update_component_"+component.id+"_form"&#125;&#125;'
                        ]) !!}
                    </div>
                @endforeach

            </div>

            <div class="col s12">
                <div class=" pull-right">
                    {!! Form::submit("Guardar", [
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
