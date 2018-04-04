@extends('layouts.app')
@section('content')
{{ Breadcrumbs::render('settings') }}
<div class="columns">
	<div class="column">
		<div class="column is-6 is-offset-3">
			{!! Form::open(['route' => 'dashboard.settingsChangePassword']) !!}
			<h3 class="title is-3">Change Password</h3>
			<div class="field is-grouped-centered">
				<label class="label">Current Password</label>
				<p class="control is-expanded">
					<input type="password" name="current_password" class="input is-expanded">
				</p>
			</div>
			<div class="field is-grouped-centered">
				<label class="label">New Password</label>
				<p class="control is-expanded">
					<input type="password" name="password" class="input is-expanded">
				</p>
			</div>
			<div class="field is-grouped-centered">
				<label class="label">New Password Confirmation</label>
				<p class="control is-expanded">
					<input type="password" name="password_confirmation" class="input is-expanded">
				</p>
			</div>
			<div class="field is-grouped">
				<div class="control">
					<button type="submit" class="button is-link">Change Password</button>
				</div>
			</div>
			{!! Form::close() !!}
			{{-- <h3 class="title is-3 p-t-md">Image Framerate</h3> --}}
		</div>
	</div>
</div>
@endsection