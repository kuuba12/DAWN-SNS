@extends('layouts.login')

@section('content')
<div class='search'>
  {{Form::open(['url'=> '/searchUser','class'=> 'searchUser'])}}
  {{Form::input('text','user',null,['class'=> 'form-search','placeholder'=>'ユーザー検索'])}}
    <input type="image" src="{{asset('images/search.png')}}" class="search-icon">

  {{Form::close()}}
      @if(isset($keyword))
      <!-- isset　検索した値が入っていた場合はそれを表示する -->
      <p class="keyword">検索ワード：{{$keyword}}</p>
      @endif
</div>

<table class='table-hover'>
  @foreach ($users as $users)
  <tr>
    <td class="icon">
        <img src="{{'images/'.$users->images}}" class="user-logo"></td>
    <td>{{$users->username}}</td>
@if(in_array ( $users->id, array_column($follow,'follow')))
<!--
  in_array ( $値, $配列,)
第一引数 配列に含まれるか調べたい値
第二引数 対象の配列
第三引数 厳密に型までの比較を行うか
array_column( $配列 , $取り出すカラム名 [, $インデックスに指定するカラム名] )
-->
  <!-- $followsで返されたものが'follow'に当てはまったら -->
  <!-- 入っていなかったらフォローする -->
<td>
<a class="followButton" href="/unFollow/{{ $users->id }}">フォローを外す</a>
</td>
@else
<td>
  <a class="followButton" href="/follow/{{ $users->id }}">フォローする</a>
</td>
@endif
  </tr>
  @endforeach
  </table>
@endsection
