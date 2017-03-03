@extends('layouts.admin')

@section('title')
    Manuales
@endsection

@section('h1')
    Manuales
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         =>  'Manuales',
        'instructions'  =>  'Proximamente'
    ])

    <div class="col s10 offset-s1">
        <div class="row manuals">

            <div class="manuals__container">
                <iframe class="manuals__container--video" src="{{ env("CLTVO_MANUAL_URL") }}" frameborder="0" allowfullscreen></iframe>
            </div>

        </div>
    </div>

@endsection
