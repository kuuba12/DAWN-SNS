@extends('layouts.logout')

@section('content')

<div id="login">
<p>{{Session::get('username')}}さん、</p>
<p>ようこそ！DAWNSNSへ！</p>
<p>ユーザー登録が完了しました。</p>
<p>さっそく、ログインをしてみましょう。</p>
<p><button type="submit" class="login-btn">
<a class="login-btn-btn" href="/login">ログイン画面へ</a>
</button></p>
</div>

@endsection
