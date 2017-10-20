@extends('layouts.client')


@section('content')
	<div class="set page">
		<div class="set--wrap wrap">

			<div class="set--title page-title">
				{!! trans('auth.password_set.label') !!}
			</div>

			{!! Form::open([
				'method'	=> 'PATCH',
				'route'		=> ['client::pass_set:patch',$encode_email],
				'role'		=> 'form',
				'id'		=> 'set_pasword_form',
				'class'		=> 'form'
				]) !!}

				{!! Form::password('password', [
					'class' => 'form--input',
					'required' => 'required',
					'placeholder' => trans('auth.password_set.form.password.placeholder')
					]) !!}

				{!! Form::password('password_confirmation', [
					'class' => 'form--input',
					'required' => 'required',
					'placeholder' =>  trans('auth.password_set.form.password_confirmation.placeholder')
					]) !!}

				<button type="submit" class="form--submit">
					{!! trans('auth.password_set.form.save') !!}
				</button>

			{!! Form::close() !!}

		</div>
	</div>
@endsection
