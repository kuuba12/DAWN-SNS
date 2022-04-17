@extends('layouts.login')

@section('content')
{{Form::open(['url'=> '/create'])}}
{{Form::input('text','newPost',null,['required','class'=> 'form-control','placeholder'=>'何をつぶやこうか？'])}}
<button type="submit">送信</button>
{{Form::close()}}

<table class='table table-hover'>
  @foreach ($list as $list)
  <tr>
    <td><img src="{{asset('images/'.$list->images)}}" class="user-logo"></td>
    <td>{{$list->username}}</td>
    <td>{{$list->posts}}</td>
    <td>{{$list->created_at}}</td>
      @if($list->user_id == Auth::id())
        <td><a class="btn update" href=""><img src="images/edit.png" class="modal-open" data-target="modal{{$list->id}}"></a></td>
        <!-- モーダルウィンドウをdivタグで作成 -->
        <div class="modal-main js-modal" id="modal{{$list->id}}">
            <!-- モーダルの白背景 -->
            <div class="modal-inner">
                {{Form::open(['url'=> '/update'])}}
                <!-- 第一引数がname第二引数がvalue、$listのIDを送る為 -->
                {{ Form::hidden('id', $list->id) }}
                <!-- Form::inputの第三引数は初期値 -->
                {{Form::input('text','upPost',$list->posts,['required','class'=> 'form-update'])}}
                <button type="submit" class="btn update">
                <img src="images/edit.png"></button>
                <p class="text-form">最大150文字</p>
                {{Form::close()}}
            </div>
        </div>
        <td><a class="btn danger" href="/post/{{$list->id}}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')"><img src="images/trash_h.png"></a></td>
      @endif
  </tr>
  @endforeach
</table>

@endsection
