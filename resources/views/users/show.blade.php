@extends('layouts.client')

@section('content')

    <div class="account">
        <div class="account--wrap wrap">
            <div class="user-page-title">
                Mi Perfil
            </div>
            <div class="account--content">

                <div class="account__col">
                    <b class="account__col--title">Actualizar Correo Electrónico</b>
                    <span class="account__col--label">Correo Electrónico:</span>
                    <span class="account__col--value">{{ $user->email }}</span>

                    @include('users._update_email_form')

                </div>

                <div class="account__col">
                    <b class="account__col--title">Actualizar Contraseña</b>
                    <span class="account__col--label">Contraseña:</span>
                    <span class="account__col--value">**********</span>

                    @include('users._update_password_form')

                </div>

            </div>
        </div>
    </div>

@endsection