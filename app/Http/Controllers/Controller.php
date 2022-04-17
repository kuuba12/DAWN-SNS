<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Auth;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
// ?
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {

            $followCount = DB::table('follows')
                        ->where('follower', Auth::id())
                        ->count();

            View::share('followCount', $followCount);

            $followerCount = DB::table('follows')
                        ->where('follow', Auth::id())
                        ->count();

            View::share('followerCount', $followerCount);

            return $next($request);
        });
    }

}
