@extends('layouts.login')

@section('content')

<ul class='otherProfile'>
  @foreach ($users as $users)
      <li class="icon"><img src="{{asset('images/'.$users->images)}}" class="user-logo"></li>
      <li class="name">Name {{$users->username}}</li>
      <li class="name">Bio {{$users->bio}}</li>
          @if(in_array ( $users->id, array_column($follow,'follow')))
          <!-- in_array ( $値, $配列,)
          第一引数 配列に含まれるか調べたい値
          第二引数 対象の配列
          第三引数 厳密に型までの比較を行うか
          array_column( $配列 , $取り出すカラム名 [, $インデックスに指定するカラム名] )-->
            <li class="btn"><a class="followButton" href="/unFollow/{{ $users->id }}">フォローを外す</a></li>
            @else
            <li class="btn"><a class="followButton" href="/follow/{{ $users->id }}">フォローする</a></li>
          @endif
  @endforeach
</ul>
<table class="other">
    @foreach($posts as $posts)
    <tr>
          <td class="icon"><img src="{{asset('images/'.$posts->images)}}" class="user-logo"></td>
          <td>{{$posts->username}}</td>
          <td>{{$posts->posts}}</td>
          <td>{{$posts->created_at}}</td>
    </tr>
    @endforeach
</table>
  @endsection
