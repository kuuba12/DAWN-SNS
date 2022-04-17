<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class UsersController extends Controller
{
//プロフィール
    // 現在認証されているユーザーの取得
        public function profile(){
        $users = Auth::user();
        return view('users.profile',['users'=>$users]);
    }
    //更新機能
    public function update(Request $request){
        // dd($request->file('images'));
    //ファイルがある時とない時の条件分岐
        if($request->file('images')){
        //拡張子付きでファイル名を取得
        $images_name=$request
        ->file('images')
        ->getClientOriginalName();
        $request->file('images')
        ->storeAs('images', $images_name, 'public_uploads');
        }else{
        //もともと入っているファイルをそのまま渡す
        $images_name=Auth::user()->images;
        };
        DB::table('users')
        ->where('id',Auth::id())
        ->update([
        'username'=>$request['username'],
        'mail'=>$request['mail'],
        'password'=>bcrypt($request['password']),
        'bio'=>$request['bio'],
        'images'=>$images_name,
        ]);
                return redirect('/profile');
    }
//ユーザー検索
    public function searchUser(Request $request){
        //あいまい検索の関数
        $keyword = $request->input('user');

        $follow = DB::table('follows')
        //Auth::idが自分の事
        ->where('follower',Auth::id())
        ->get()
        ->toarray();
        $users = DB::table('users')
        //あいまい検索
        ->where('username','like','%'.$keyword.'%')->get();
        return view('users.search',['users'=>$users, 'follow'=>$follow]);
    }
 }
