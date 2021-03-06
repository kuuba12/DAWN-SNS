@extends('layouts.login')

@section('content')

<p class="followList">follow list</p>

<table class='table-first'>
  @foreach($follow_list as $follow_list)
<tr>
  <td>
    <!-- アイコンの表示 -->
    <a href="/otherProfile/{{$follow_list->id}}"><img src="{{'images/'.$follow_list->images}}" class="user-logo"></a>
  </td>
</tr>
@endforeach
</table>

<p class="line"></p>

<table class='table-second'>
  @foreach($post as $post)
  <tr class="follow">
    <!-- アイコンの表示 -->
    <td>
      <a href="/otherProfile/{{$post->id}}"><img src="{{'images/'.$post->images}}" class="user-logo"></a>
    </td>
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
    <a class="followButton" href="/unFollow/{{ $post->id }}">フォローを外す</a>
    </td>
    @else
    <td>
      <a class="followButton" href="/follow/{{ $post->id }}">フォローする</a>
    </td>
    @endif
  </tr>
  @endforeach
</table>



@endsection
