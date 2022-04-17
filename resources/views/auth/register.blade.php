@extends('layouts.logout')

@section('content')

{!! Form::open() !!}
<div id="login">
<p>新規ユーザー登録</p>

<div class="login-form">{{ Form::label('UserName') }}
<br>{{ Form::text('username',null,['class' => 'input']) }}<br>
</div>
@if($errors->has('username'))
<p class="error">{{ $errors->first('username') }}</p>
@endif

<div class="login-form">
{{ Form::label('MailAddress') }}
<br>{{ Form::text('mail',null,['class' => 'input']) }}<br>
</div>
@if($errors->has('mail'))
<p class="error">{{ $errors->first('mail') }}</p>
@endif

<div class="login-form">
{{ Form::label('Password') }}
<br>{{ Form::text('password',null,['class' => 'input']) }}<br>
</div>

@if($errors->has('password'))
<p class="error">{{ $errors->first('password') }}</p>
@endif

<div class="login-form">
{{ Form::label('Password confirm') }}
<br>{{ Form::text('password_confirmation',null,['class' => 'input']) }}<br>
</div>

<p class="btn">
{{ Form::submit('登録',['class'=>'btn']) }}
</p>
<p><a href="/login">ログイン画面へ戻る</a></p>
</div>
{!! Form::close() !!}


@endsection
