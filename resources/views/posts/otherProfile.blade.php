@extends('layouts.login')

@section('content')

<table class='table'>
  @foreach ($users as $users)
    <tr>
      <td class="icon"><img src="{{asset('images/'.$users->images)}}" class="user-logo"></td>
      <td>Name{{$users->username}}</td>
      <td>Bio{{$users->bio}}</td>
          @if(in_array ( $users->id, array_column($follow,'follow')))
          <!-- in_array ( $値, $配列,)
          第一引数 配列に含まれるか調べたい値
          第二引数 対象の配列
          第三引数 厳密に型までの比較を行うか
          array_column( $配列 , $取り出すカラム名 [, $インデックスに指定するカラム名] )-->
            <td><a href="/unFollow/{{ $users->id }}">フォローを外す</a></td>
            @else
            <td><a href="/follow/{{ $users->id }}">フォローする</a></td>
          @endif
    </tr>
  @endforeach

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
