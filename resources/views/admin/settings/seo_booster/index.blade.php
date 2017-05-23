@extends('layouts.admin')

@section('title')
    Seo Booster
@endsection

@section('h1')
    Seo Booster
@endsection

@section('content')

    <div class="col s10 offset-s1">
        <div class="row">
            @foreach ($seo_boosters as $seo_booster)
                {{-- Imágen --}}
                <div class="input-field col s6">
                    <img src="{{ $seo_booster->thumbnail_image->url }}">
                </div>

                {{-- Title --}}
                @foreach($seo_booster->languages()->get() as $language)
                    <div class="input-field col s12">
                        {!! Form::label($seo_booster->route_name . '[' . $language->iso6391 . ']', trans('manage_seo_booster.title') . ' [' . $language->language_label . ']', ['class' => 'input-label']) !!}
                        {!! Form::text($seo_booster->route_name . '[' . $language->iso6391 . ']', $language->pivot->title, [
                            'class' => 'form-control'
                        ]) !!}
                    </div>
                @endforeach

                {{-- Description --}}
                @foreach($seo_booster->languages()->get() as $language)
                    <div class="input-field col s12">
                        {!! Form::label($seo_booster->description . '[' . $language->iso6391 . ']', trans('manage_seo_booster.description') . ' [' . $language->language_label . ']', ['class' => 'input-label']) !!}
                        {!! Form::text($seo_booster->description . '[' . $language->iso6391 . ']', $language->pivot->description, [
                            'class' => 'form-control'
                        ]) !!}
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

@endsection
