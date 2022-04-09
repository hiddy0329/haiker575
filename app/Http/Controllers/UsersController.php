<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class UsersController extends Controller
{
    public function show($id){
        // 送られてきたidがデータベースのuser_idと一致するものを取得する
        $user = User::where('id', $id)->first();
        // dd($user);
        $posts = Post::where('status', 1)->orderBy('updated_at', 'DESC')->get();
        // //取得した句をViewに渡す
        return view('users/show',compact('user', 'posts'));
    }
}
