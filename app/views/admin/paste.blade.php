@extends('admin.layout')

@section('module')
	<section id="admin-paste">
		{{
			Form::open(array(
				'autocomplete'   => 'off',
				'role'           => 'form'
			))
		}}

		<div class="row">
			<div class="col-sm-12 form-inline">
				{{
					Form::text('search', NULL, array(
						'class'         => 'form-control',
						'maxlength'     => 30,
						'placeholder'   => Lang::get('global.paste_id')
					))
				}}

				{{
					Form::submit(Lang::get('global.search'), array(
						'class'   => 'btn btn-primary'
					))
				}}
			</div>
		</div>
		<br />

		<div class="row">
			<div class="col-sm-12 form-inline">
				@if ( ! empty($paste))
					<table class="table table-white">
						<colgroup>
							<col class="col-xs-3 col-sm-2" />
							<col class="col-xs-9 col-sm-10" />
						</colgroup>

						<thead>
							<tr>
								<th>{{ Lang::get('admin.field') }}</th>
								<th>{{ Lang::get('admin.value') }}</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td>{{ Lang::get('global.paste_id') }}</td>
								<td>#{{ $paste->urlkey ?: $paste->id }}</td>
							</tr>

							<tr>
								<td>{{ Lang::get('global.paste_title') }}</td>
								<td>{{{ $paste->title ?: '-' }}}</td>
							</tr>

							<tr>
								<td>{{ Lang::get('global.paste_data') }}</td>
								<td>{{{ Paste::getAbstract($paste->data) }}}</td>
							</tr>

							<tr>
								<td>{{ Lang::get('global.author') }}</td>
								<td>{{ $paste->author ?: Lang::get('global.anonymous') }}</td>
							</tr>

							<tr>
								<td>{{ Lang::get('global.paste_lang') }}</td>
								<td>{{ $paste->language }}</td>
							</tr>

							<tr>
								<td>{{ Lang::get('admin.posted_at') }}</td>
								<td>{{ date('d M Y, H:i:s e', $paste->timestamp) }}</td>
							</tr>

							<tr>
								<td>{{ Lang::get('admin.expires_at') }}</td>
								<td>{{ date('d M Y, H:i:s e', $paste->expire) }}</td>
							</tr>

							<tr>
								<td>{{ Lang::get('admin.is_private') }}</td>
								<td>{{ $paste->private ? Lang::get('global.yes') : Lang::get('global.no') }}</td>
							</tr>

							<tr>
								<td>{{ Lang::get('admin.has_password') }}</td>
								<td>{{ $paste->password ? Lang::get('global.yes') : Lang::get('global.no') }}</td>
							</tr>

							<tr>
								<td>{{ Lang::get('admin.poster_ip') }}</td>
								<td>{{ $paste->ip }}</td>
							</tr>
						</tbody>
					</table>

					<div class="inline">
						@if ($paste->password)
							{{
								link_to('admin/paste/'.Paste::getUrlKey($paste).'/rempass', Lang::get('admin.remove_password'), array(
									'class' => 'btn btn-primary'
								))
							}}
						@endif

						{{
							link_to('admin/paste/'.Paste::getUrlKey($paste).'/toggle',
								$paste->private ? Lang::get('global.make_public') : Lang::get('global.make_private'),
								array(
									'class' => 'btn btn-primary'
								)
							)
						}}

						{{
							link_to('admin/paste/'.Paste::getUrlKey($paste).'/delete', Lang::get('global.delete'), array(
								'class'     => 'btn btn-primary',
								'onclick'   => "return confirm('".Lang::get('global.action_confirm')."')",
							))
						}}
					</div>
				@else
					<div class="jumbotron text-center">
						<h1><span class="glyphicon glyphicon-search text-warning"></span></h1>
						<h2>{{ Lang::get('admin.paste_exp') }}</h2>
					</div>
				@endif
			</div>
		</div>

		{{ Form::token() }}
		{{ Form::close() }}
	</section>
@stop