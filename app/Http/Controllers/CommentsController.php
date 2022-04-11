<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:1000', 'user_id' => 'required', 'post_id' => 'required'
        ]);
        // $requestとしてhtmlから投げられたデータを全て$dataに代入する
        $data = $validated;
        // dd($data);
        // COMMENTモデルにDBへ保存する命令を出す
        $comment_id = Comment::insertGetId([
            'text' => $data['text'], 'user_id' => $data['user_id'], 'post_id' => $data['post_id'], 'status' => 1
        ]);
        
        // リダイレクト処理
        return redirect()->route('home');
    }
}
