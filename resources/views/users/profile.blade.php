@extends('layouts.login')

@section('content')

	{{Form::open(['url' => '/profile', 'files' => true])}}

							@if ($errors->any())
										<div class="alert alert-danger">
												<ul>
														@foreach ($errors->all() as $error)
																<li>{{ $error }}</li>
														@endforeach
												</ul>
										</div>
							@endif

	<div class="profile-logo">
	<img src="{{'images/' . Auth::user()->images }}" class="user-logo">
	</div>

	<div class="profile">
	{{ Form::label('UserName') }}
	{{ Form::text('username', $users->username,['class' => 'update']) }}
	</div>

	<div class="profile">
	{{ Form::label('MailAdress') }}
	{{ Form::text('mail', $users->mail,['class' => 'update']) }}
	</div>

	<div class="profile">
	{{ Form::label('Password') }}
	{{ Form::text('old_password', $users->password,['readonly','class' => 'update'])}}
	</div>

	<div class="profile">
	{{ Form::label('new Password') }}
	{{ Form::password('password', ['class' => 'update'])}}
	</div>

	<div class="profile">
	{{ Form::label('Bio') }}
	{{ Form::text('bio', $users->bio,['class' => 'update']) }}
	</div>

	<div class="profile">
	{{ Form::label('Icon Images') }}
	{{Form::file('images',['class' => 'update'])}}
	</div>

	<div class="profile-btn">
	{{ Form::submit('更新',['class' => 'update-btn']) }}
	</div>

	{{ Form::close()}}
	@endsection
