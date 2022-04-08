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
        // 投句一覧をモデルを通じて取得する
        // 論理削除モデルを使用してステータスが1のもののみ取得するようにする
        $posts = Post::where('status', 1)->orderBy('updated_at', 'DESC')->get();
        return view('home', compact('posts'));
    }

    public function create()
    {
        // ログインしているユーザーの情報をビューに渡す処理をする
        $user = \Auth::user();
        // 投句一覧を取得
        $posts = Post::where('status', 1)->orderBy('updated_at', 'DESC')->get();
        // compactにユーザーデータを入れて渡す
        return view('create', compact('user', 'posts'));
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

    public function edit($id){
        // 該当するIDの句をデータベースから取得
        $user = \Auth::user();
        // ステータスが1かつ送られてきたidがデータベースのpost_idと一致するものかつログインしているユーザーのものを取得する
        $post = Post::where('status', 1)->where('id', $id)->where('user_id', $user['id'])->first();
        // dd($post);
        $posts = Post::where('status', 1)->orderBy('updated_at', 'DESC')->get();
        //取得した句をViewに渡す
        return view('edit',compact('post', 'user', 'posts'));
    }

    public function update(Request $request, $id)
    {   
        // リクエストファザードでidもしっかりと受け取る。どのレコードを更新するのかを判別するのに必要だから。
        $inputs = $request->all();
        // dd($inputs);
        Post::where('id', $id)->update(['ku' => $inputs['ku'], 'description' => $inputs['description'] ]);
        return redirect()->route('home');
    }

    public function show($id){
        // ログインしているユーザーの情報を取得
        $user = \Auth::user();
        // ステータスが1かつ送られてきたidがデータベースのpost_idと一致するものを取得する
        $post = Post::where('status', 1)->where('id', $id)->first();
        // dd($post);
        $posts = Post::where('status', 1)->orderBy('updated_at', 'DESC')->get();
        //取得した句をViewに渡す
        return view('show',compact('post', 'user', 'posts'));
    }
    
    public function delete(Request $request, $id)
    {   
        $inputs = $request->all();
        // dd($inputs);
        // 論理削除モデルを用いて削除する
        Post::where('id', $id)->update(['status' => 2]);
        // 削除時に'success'という名前でフラッシュメッセージを渡す
        return redirect()->route('home')->with('success', '俳句の削除が完了しました!');
    }

    public function search(Request $request)
    {   
        // リクエストからフォームの中の値を受け取る
        $keyword = $request->get('keyword');
        if ($keyword !== null) {
            $escape_word = addcslashes($keyword, '\\_%');
            // postsテーブルから曖昧検索を実行する
            $posts = Post::where('ku', 'like', '%' . $escape_word . '%')->get();
        } else {
            $posts = Post::all();
        }
        return view('home', compact('posts'));
    }
}
