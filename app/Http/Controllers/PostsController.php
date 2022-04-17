<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class PostsController extends Controller
{

    public function index(){

        $list = DB::table('users')
        ->join('posts','users.id','=','user_id')
        ->join('follows','users.id','=','follow')
        ->where('follows.follower',Auth::id())
        // orWhere()でOR検索
        ->orWhere('user_id', Auth::id())
        ->orderBy('posts.created_at','desc')
        ->select('users.username', 'users.images', 'posts.id', 'posts.user_id', 'posts.posts', 'posts.created_at', 'posts.updated_at')
        ->get();

        return view('posts.index',['list'=>$list]);
    }

    public function create(Request $request){
        DB::table('posts')->insert([
            'user_id' => Auth::id(),
            'posts' => $request->input('newPost'),
            'created_at'=>now(),

        ]);
        return redirect('/top');
    }

    public function delete($id){
        DB::table('posts')
        ->where('id',$id)
        ->delete();

        return redirect('/top');
}

    public function update(Request $request){
        // $listのpostIDを$idに入れる
        $id = $request->input('id');

        DB::table('posts')
        ->where('id',$id)
        ->update([
            'posts'=>$request['upPost'],
            'created_at'=> now(),
        ]);

        return redirect('/top');
    }

}
