@extends('layouts.client')

@section('content')

    <div class="account">
        <div class="account--wrap wrap">
            <div class="user-page-title">
                {!! trans('user.layout.my_account') !!}
            </div>
            <div class="account--content">

                <div class="account__col">
                    <b class="account__col--title">{!! trans('user.update_email.update_label') !!}</b>
                    <span class="account__col--label">{!! trans('user.update_email.label') !!}</span>
                    <span class="account__col--value">{{ $user->email }}</span>

                    @include('users._update_email_form')

                </div>

                <div class="account__col">
                    <b class="account__col--title">{!! trans('user.update_password.update_label') !!}</b>
                    <span class="account__col--label">{!! trans('user.update_password.label') !!}</span>
                    <span class="account__col--value">**********</span>

                    @include('users._update_password_form')

                </div>

            </div>
        </div>
    </div>

@endsection
