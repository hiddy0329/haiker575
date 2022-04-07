@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        <div class="card-header d-flex justify-content-between">
            俳句詳細
            <form method='POST' action="/delete/{{$post['id']}}" id='delete-form'>
                @csrf
                <button class='p-0 mr-2' style='border:none;'><i id='delete-button' class="fas fa-trash-alt"></i></button>
            </form> 
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h1 class="ku">{{ $post['ku'] }}</h2>
            </div>
            <p class="description p-3">{{ $post['description'] }}</p>
            <p class="px-3">作者：{{ $post->user->name }}</p>
                @if (Auth::id() == $post->user_id)
                    <a href="/edit/{{ $post['id'] }}" class='px-3'>推敲</a>
                @endif
            
            <form method='POST' action="/posts/{{ $post->id }}/comments" class="border border-light mt-3">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <input type='hidden' name='post_id' value="{{ $post['id'] }}">
                <div class="form-group">
                    <label for="text">【コメント入力】</label>
                    <textarea name='text' class="form-control"rows="10"></textarea>
                </div>
                <button type='submit' class="btn btn-primary btn-lg">コメント投稿</button>
            </form>
            
            <!-- トリガーとなるリンク&ボタン -->
            <button class="btn btn-success mt-3 w-100" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                <h4>コメントを見る▼▼</h4>
            </button>
            <!-- /トリガーとなるリンク&ボタン -->

            <!-- 対象のコンテンツ -->
            <div class="collapse mt-2 border border-secondary rounded" id="collapseExample1">
            @foreach($post->comments as $comment)
                <div class="d-flex mt-1">
                    <p class="w-25">{{ $comment->user->name }}：</p>
                    <p class="w-75">{{ $comment['text'] }}</p>
                </div>
            @endforeach 
            </div>
            <!-- /対象のコンテンツ -->
        </div>
    </div>
</div>
@endsection
