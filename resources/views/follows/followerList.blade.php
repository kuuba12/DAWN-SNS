@extends('layouts.login')

@section('content')

<h1>follower list</h1>

<table class='table-first'>
  @foreach($follower_list as $follower_list)
<tr>
  <td>
    <!-- アイコンの表示 -->
    <a href="/otherProfile/{{$follower_list->id}}"><img src="{{'images/'.$follower_list->images}}" class="user-logo"></a>
  </td>
</tr>
@endforeach
</table>

<table class='table-second'>
  @foreach($post as $post)
  <tr>
    <!-- アイコンの表示 -->
    <td class="icon">
    <a href="/otherProfile/{{$post->id}}"><img src="{{'images/'.$post->images}}" class="user-logo"></td></a>
    <td>{{$post->username}}</td>
    <td>{{$post->posts}}</td>
    <td>{{$post->created_at}}</td>
    @if(in_array ( $post->id, array_column($follow,'follow')))
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
<a href="/unFollow/{{ $post->id }}">フォローを外す</a>
</td>
@else
<td>
  <a href="/follow/{{ $post->id }}">フォローする</a>
</td>
@endif
  </tr>
  @endforeach
</table>
@endsection
