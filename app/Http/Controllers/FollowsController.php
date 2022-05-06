<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class FollowsController extends Controller
{
    //フォローリスト
    public function followList()
    {
        $follow_list=DB::table('users')
        //usersのusers.idとfollowsのfollowを内部結合
        ->join('follows','users.id','=','follow')
        ->where('follows.follower',Auth::id())
        ->select('users.id','users.images')
        ->get();

        $post=DB::table('users')
        //usersのusers.idとpostsのuser_idを内部結合
        ->join('posts','users.id','=','user_id')
        //usersのusers.idとfollowsのfollowを内部結合
        ->join('follows','users.id','=','follow')
        ->where('follows.follower',Auth::id())
                ->select('users.id','users.images','users.username','posts.posts','posts.created_at')
        ->orderBy('posts.created_at','desc')
        ->get();

        $follow = DB::table('follows')
        //Auth::idが自分の事
        ->where('follower',Auth::id())
        ->get()
        ->toarray();

        return view('follows.followList',['follow_list'=>$follow_list,'post'=>$post,'follow'=>$follow]);
    }

    //フォロワーリスト
    public function followerList(){
        $follower_list=DB::table('users')
        ->join('follows','users.id','=','follower')
        ->where('follows.follow',Auth::id())
        ->select('users.id','users.images')
        ->get();

        $post=DB::table('users')
        //usersのusers.idとpostsのuser_idを内部結合
        ->join('posts','users.id','=','user_id')
        //usersのusers.idとfollowsのfollowを内部結合
        ->join('follows','users.id','=','follower')
        ->where('follows.follow',Auth::id())
        ->select('users.id','users.images','users.username','posts.posts','posts.created_at')
        ->orderBy('posts.created_at','desc')
        ->get();

        $follow = DB::table('follows')
        //Auth::idが自分の事
        ->where('follower',Auth::id())
        ->get()
        ->toarray();

        return view('follows.followerList',['follower_list'=>$follower_list,
    'post'=>$post,'follow'=>$follow]);
    }

    //フォローする
    public function follow($id){
        DB::table('follows')->insert([
            'follower'=>Auth::id(),
            'follow'=>$id
        ]);
        return back();
    }

    //フォローを外す
    public function unFollow($id){
        DB::table('follows')
        ->where('follow',$id)
        ->where('follower',Auth::id())
        ->delete();
        return back();
    }

    //相手のプロフィール
    public function otherProfile($id){
        $users=DB::table('users')
        ->where('id',$id)
        ->get();

        $posts=DB::table('users')
        ->join('posts','users.id','=','user_id')
        ->where('users.id',$id)
        ->get();

        $follow = DB::table('follows')
        //Auth::idが自分の事
        ->where('follower',Auth::id())
        ->get()
        ->toarray();

        return view('posts.otherProfile',['users'=>$users,'posts'=>$posts,'follow'=>$follow]);
    }
}
