@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div id="login">
<p>DAWNSNSへようこそ</p>

<div class="login-form">{{ Form::label('MailAddress') }}
<br>{{ Form::text('mail',null,['class' => 'input']) }}<br>
</div>
<div class="login-form">{{ Form::label('password') }}
<br>{{ Form::password('password',['class' => 'input']) }}<br>
</div>
<p class="btn">{{ Form::submit('LOGIN',['class' => 'btn']) }}</p>

<p><a href="/register">新規ユーザーの方はこちら</a></p>
</div>
{!! Form::close() !!}

@endsection
