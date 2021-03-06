<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Common\getDataClass;
use App\Common\getUserClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'search');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        // ログインしているユーザーの情報をビューに渡す処理をする
        $user = getUserClass::getUser();
        // 投句一覧をモデルを通じて取得する
        // 論理削除モデルを使用してステータスが1のもののみ取得するようにする
        $posts = getDataClass::getData();
        return view('home', compact('user', 'posts'));
    }

    public function create()
    {
        // ログインしているユーザーの情報をビューに渡す処理をする
        $user = getUserClass::getUser();
        // 投句一覧を取得
        $posts = getDataClass::getData();
        // compactにユーザーデータを入れて渡す
        return view('create', compact('user', 'posts'));
    }

    public function store(Request $request)
    {   
        // 送られてきたデータから画像データを取得
        $image = $request->file('image');

        // 画像がアップロードされていれば、storageに保存
        if($request->hasFile('image')){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        }else{
            $path = null;
        }

        // 他のデータに対しバリデーションを実行
        $validated = $request->validate([
            'ku' => 'required|string|max:30','description' => 'required|string|max:1000', 'user_id' => 'required' 
        ]);
        // バリデーションを通過したデータを全て$dataに代入する
        $data = $validated;
        // dd($data);

        // POSTモデルにDBへ保存する命令を出す
        $post_id = Post::insertGetId([
            'ku' => $data['ku'], 
            'description' => $data['description'], 
            'user_id' => $data['user_id'], 
            'image' => $path[1],
            'status' => 1
        ]);
        
        // リダイレクト処理
        return redirect()->route('home')->with('success', '俳句の投稿が完了しました!');
    }

    public function edit($id){
        // ログインしているユーザーの情報をビューに渡す処理をする
        $user = getUserClass::getUser();
        // ステータスが1かつ送られてきたidがデータベースのpost_idと一致するものかつログインしているユーザーのものを取得する
        $post = Post::where('status', 1)->where('id', $id)->where('user_id', $user['id'])->first();
        // dd($post);
        // 俳句一覧を取得
        $posts = getDataClass::getData();
        //取得した句をViewに渡す
        return view('edit',compact('post', 'user', 'posts'));
    }

    public function update(Request $request, $id)
    {   
        // 送られてきたデータから画像データを取得
        $image = $request->file('image');
        
        // 画像がアップロードされていれば、storageに保存
        if($request->hasFile('image')){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
        }else{
            $path = null;
        }

        // 他のデータに対しバリデーションを実行
        $validated = $request->validate([
            'ku' => 'required|string|max:30','description' => 'required|string|max:1000', 'user_id' => 'required' 
        ]);

        // バリデーションを通過したデータを全て$inputsに代入する
        $inputs = $validated;
        // dd($inputs);
        // POSTモデルにDBへ保存する命令を出す
        Post::where('id', $id)->update(['ku' => $inputs['ku'], 'description' => $inputs['description'], 'image' => $path[1] ]);
        
        return back()->with('success', '更新しました!');
    }

    public function show($id){
        // ログインしているユーザーの情報を取得
        $user = getUserClass::getUser();
        // ステータスが1かつ送られてきたidがデータベースのpost_idと一致するものを取得する
        $post = Post::where('status', 1)->where('id', $id)->first();
        // dd($post);
        $posts = getDataClass::getData();
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
