@extends('layouts.client')

@section('content')
	<div class="auth page">

		<div class="auth--title page-title">
			{!! trans('auth.password_reset_email.label') !!}
		</div>

		<form class="form" role="form" method="POST" action="{{ route('client::pass_reset_email') }}">
			{{ csrf_field() }}

			<div class="email__input-container">
				<input id="email" type="email" class="form--input" placeholder="{!! trans('auth.password_reset_emailform.email.placeholder') !!}" name="email" value="{{ old('email') }}" required>
			</div>

			<div class="auth__button-container">
				<button type="submit" class="form--submit">
					{!! trans('auth.password_reset_emailform.save') !!}
				</button>
			</div>
		</form>

	</div>
@endsection
