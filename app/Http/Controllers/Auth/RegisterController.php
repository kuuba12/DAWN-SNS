<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**なぜhome? */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     * バリデーション↓↓
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:12|min:4',
            'mail' => 'required|string|email|max:255|min:4|unique:users',
            'password' => 'required|string|regex:/^[0-9a-zA-Z]{4,12}$/|confirmed',
        ],[
            'required'=>'この項目は必須です',
            'min'=>'この項目は4文字以上です',
            'username.max'=>'名前は12文字以内で設定してください',
            'mail.max'=>'メールアドレスは25文字以内で設定してください',
            'regex'=>'半角英数字で設定してください',
            'confirmed'=>'パスワードは一致しません',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
        //  ユーザーテーブルに登録する
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
//バリデーション
    $validator=$this->validator($data);
    if ($validator->fails()){
    return redirect('register')->withErrors
    ($validator)->withInput();
}
            $this->create($data);
            return redirect('added')->with('username',$data['username']);
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
