<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Common\getDataClass;

class UsersController extends Controller
{
    public function show($id){
        // 送られてきたidがデータベースのuser_idと一致するものを取得する
        $user = User::where('id', $id)->first();
        // dd($user);
        $posts = getDataClass::getData();
        // //取得した句をViewに渡す
        return view('users/show',compact('user', 'posts'));
    }
}
