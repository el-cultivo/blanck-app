<div class="row">
    <div class="col s12">
        {{-- <img width="100%" src="http://placehold.it/1600x800" style="margin: 0 auto;display: block;"> --}}
        <single-image
            v-ref:"page"
            {{-- :current-image="store.current_page.thumbnail_image" --}}
            type="main"
            photoable-id="{{$page->id}}"
            photoable-type="page"
            use="thumbnail"
            class=""
            default-order="null"
        ></single-image>
    </div>
</div>

<div class="row">
    @foreach ($languages as $language)
        <div class="input-field col s12">
            {{ 'Cotenido ('.$language->label.') :' }} <br><br>
            {!! Form::textarea( "content[".$language->iso6391."]", $page->translation($language->iso6391)->content, [
                'class'	   => 'materialnote_JS',
            ]) !!}
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col s12">

        <textarea name="editor" class="summernote_JS" id="first">
            <h2 id="title">The Art of War</h2>
            <p>
                <blockquote>
                    If you know the enemy and know yourself, you need not fear the result of a hundred battles.<br> If you know yourself but not the enemy, for every victory gained you will also suffer a defeat.<br>
                    If you know neither the enemy nor yourself, you will succumb in every battle.
                </blockquote>

                <ul>
                    <li>If your enemy is secure at all points, be prepared for him. If he is in superior strength, evade him.</li>
                    <li>If your opponent is temperamental, seek to irritate him.</li>
                    <li>Pretend to be weak, that he may grow arrogant.</li>
                    <li>If he is taking his ease, give him no rest.</li>
                    <li>If his forces are united, separate them.</li>
                    <li>If sovereign and subject are in accord, put division between them. Attack him where he is unprepared, appear where you are not expected.</li>
                </ul>

                <ol>
                    <li>There are not more than five musical notes, yet the combinations of these five give rise to more melodies than can ever be heard.</li>
                    <li>There are not more than five primary colours, yet in combination</li>
                    <li>they produce more hues than can ever been seen.</li>
                    <li>There are not more than five cardinal tastes, yet combinations of</li>
                    <li>them yield more flavours than can ever be tasted.</li>
                </ol>

                <span style="font-weight: bold; background-color: rgb(156, 39, 176); color: rgb(250, 250, 250);">
                    There are roads which must not be followed, armies which must not be attacked, towns which must not be sieged, positions which must not be contested, commands of the sovereign which must not be obeyed.
                </span>
            </p>
        </textarea>

    </div>
</div>
