@extends('common.page')

@section('body')
	<section id="login">
		{{
			Form::open(array(
				'autocomplete'   => 'off',
				'role'           => 'form'
			))
		}}

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<fieldset>
					<legend>{{ sprintf(Lang::get('user.login_to'), $site->title) }}</legend>

					@include('common.alerts')

					<div class="form-group">
						{{ Form::label('username', Lang::get('global.username')) }}

						{{
							Form::text('username', NULL, array(
								'class'       => 'form-control',
								'maxlength'   => 50
							))
						}}
					</div>

					<div class="form-group">
						{{ Form::label('password', Lang::get('global.password')) }}

						{{
							Form::password('password', array(
								'class' => 'form-control'
							))
						}}
					</div>

					<div class="checkbox">
						<label>
							{{
								Form::checkbox('remember', NULL, NULL, array(
									'id' => 'remember'
								))
							}}

							{{ Lang::get('user.remember') }}
						</label>
					</div>

					{{
						Form::submit(Lang::get('user.login'), array(
							'name'    => 'login',
							'class'   => 'btn btn-primary'
						))
					}}

					{{
						link_to('user/register', Lang::get('user.create_acct'), array(
							'class'   => 'btn btn-success',
						))
					}}
				</fieldset>
			</div>
		</div>

		{{ Form::token() }}
		{{ Form::close() }}
	</section>
@stop