@extends('layouts.app')

@section('content')

<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        @include('errors')
        <div class="card-header d-flex justify-content-between">
            推敲
            <form method='POST' action="/delete/{{$post['id']}}" id='delete-form'>
                @csrf
                <button id="delete-button" class='p-0 mr-2' style='border:none;'><i id='delete-icon' class="fas fa-trash-alt"></i></button>
            </form> 
        </div>
        <div class="card-body">
            <form method='POST' action="{{ route('update', ['id' => $post['id']]) }}" enctype="multipart/form-data">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <img src="{{ '/storage/' . $post['image']}}" class='w-100 mb-3'/>
                <div class="form-group">
                    <label for="ku">俳句</label>
                    <input name='ku' type="text" class="form-control" id="ku" placeholder="一句入力" value="{{ $post['ku'] }}">
                </div>
                <div class="form-group">
                    <label for="description">説明文</label>
                    <textarea name='description' class="form-control"rows="10">{{ $post['description'] }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">画像登録</label>
                    <input type="file" class="form-control-file" name='image' id="image">
                </div>
                <button type='submit' class="btn btn-primary btn-lg">更新</button>
            </form>

            <!-- トリガーとなるリンク&ボタン -->
            <button class="btn btn-success mt-3 w-100" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                <h4 class="refer-comments">コメントを参考にする▼▼</h4>
            </button>
            <!-- /トリガーとなるリンク&ボタン -->

            <!-- 対象のコンテンツ -->
            <div class="collapse mt-2 border border-secondary rounded" id="collapseExample1">
        @foreach($post->comments as $comment)
                <div class="d-flex mt-1">
                    <p class="w-25 comment-user">{{ $comment->user->name }}：</p>
                    <p class="w-75 comment">{{ $comment['text'] }}</p>
                </div>
        @endforeach 
            </div>
            <!-- /対象のコンテンツ -->
        </div>
    </div>
</div>
@endsection
