<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        // ログインしているユーザーの情報をビューに渡す処理をする
        $user = \Auth::user();
        // compactにユーザーデータを入れて渡す
        return view('create', compact('user'));
    }

    public function store(Request $request)
    {   
        // $requestとしてhtmlから投げられたデータを全て$dataに代入する
        $data = $request->all();
        // dd($data);
        // 送信されたデータをDB（memosテーブル）に挿入
        // POSTモデルにDBへ保存する命令を出す
        $post_id = Post::insertGetId([
            'ku' => $data['ku'], 'description' => $data['description'], 'user_id' => $data['user_id'], 'status' => 1
        ]);
        
        // リダイレクト処理
        return redirect()->route('home');
    }
    
}
