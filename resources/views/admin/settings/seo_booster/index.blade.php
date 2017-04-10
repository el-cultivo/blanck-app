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
                @foreach($languages as $language)
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            {!! Form::label($seo_booster->route_name . '[' . $language->iso6391 . ']', trans('manage_seo_booster.title'), ['class' => 'input-label']) !!}
                            {!! Form::text($seo_booster->route_name . '[' . $language->iso6391 . ']', $seo_booster->title, [
                                'class' => 'form-control summernote_JS'
                            ]) !!}
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

@endsection