<div class="row seoBooster__row">
    <div class="col-xs-8">
        <div class="row">
            {!! Form::label('inputname', 'Preview:', ['class' => 'col-xs-3 control-label text-right text__p']) !!}
            <div class="col-xs-7">
                <div class="google-search-results">
                    <div class="googleSearchResults__DIV_1">
                        <h3 class="googleSearchResults__H3_2">
                            <a href="{{ $seo->uri }}" target="_blank" class="googleSearchResults__A_3">
                                {{ $seo->translation($language->iso6391)->title }}: {{ config('app.name') }}
                            </a>
                        </h3>

                        <div class="googleSearchResults__DIV_4">
                            <div class="googleSearchResults__DIV_5">
                                <div class="googleSearchResults__DIV_6">
                                    <cite class="googleSearchResults__CITE_7">{{ $seo->uri }}</cite>
                                    <div class="googleSearchResults__DIV_9">
                                        <a href="#" class="googleSearchResults__A_10"><span class="googleSearchResults__SPAN_11"></span></a>
                                        <div class="googleSearchResults__DIV_12">
                                            <ol class="googleSearchResults__OL_13">
                                                <li class="googleSearchResults__LI_14">
                                                    <a href="http://webcache.googleusercontent.com/search?q=cache:TAMHBggvi80J:mx.hola.com/+&amp;cd=1&amp;hl=es&amp;ct=clnk&amp;gl=mx" class="googleSearchResults__A_15">En caché</a>
                                                </li>
                                                <li class="googleSearchResults__LI_16">
                                                    <a href="/search?q=related:mx.hola.com/+hola&amp;tbo=1&amp;sa=X&amp;ved=0ahUKEwjHidb7n87OAhVMx2MKHWQRA48QHwghMAA" class="googleSearchResults__A_17">Similares</a>
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div><span class="googleSearchResults__SPAN_18">{{ substr($seo->translation($language->iso6391)->description, 0, 160) }} ...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
