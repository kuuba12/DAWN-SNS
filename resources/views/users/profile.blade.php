@extends('layouts.login')

@section('content')

{{Form::open(['url' => '/profile', 'files' => true])}}

{{ Form::label('UserName') }}
{{ Form::text('username', $users->username,['class' => 'update']) }}

{{ Form::label('MailAdress') }}
{{ Form::text('mail', $users->mail,['class' => 'update']) }}

{{ Form::label('Password') }}
{{ Form::text('old_password', $users->password,['readonly'])}}

{{ Form::label('new Password') }}
{{ Form::password('password', null,['class' => 'update'])}}

{{ Form::label('Bio') }}
{{ Form::text('bio', $users->bio,['class' => 'update']) }}

{{ Form::label('Icon Images') }}
{{Form::file('images',['class' => 'update'])}}

{{ Form::submit('更新') }}

{{ Form::close()}}


@endsection
