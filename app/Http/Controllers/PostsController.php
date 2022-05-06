<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Follow;
use Validator;

class PostsController extends Controller
{

    public function index(){

        $list = DB::table('users')
        ->join('posts','users.id','=','user_id')
        //データなくてもいいように外部結合
        ->leftJoin('follows','users.id','=','follow')
        ->where('follows.follower',Auth::id())
        // orWhere()でOR検索
        ->orWhere('user_id', Auth::id())
        ->orderBy('posts.created_at','desc')
        ->select('users.username', 'users.images', 'posts.id', 'posts.user_id', 'posts.posts', 'posts.created_at', 'posts.updated_at')
        ->get();

        return view('posts.index',['list'=>$list]);
    }
    // 投稿の文字数制限
    protected function validator(array $post)
    {
        return Validator::make($post, [
            'newPost' => 'required|string|max:150',
        ], [
            'newPost.max' =>'150文字以下で入力してください',
            'newPost.required' =>'投稿を入れてください'

        ]);
    }
    public function create(Request $request){

        $data = $request->input();
        $post = $request->input('newPost');

        $val = $this->validator($data);

        if($val->fails()){
            return redirect('/top')
                ->withErrors($val)
                ->withInput();
        }


        DB::table('posts')->insert([
            'user_id' => Auth::id(),
            'posts' => $post,
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
