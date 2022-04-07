@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        <div class="card-header">コメント</div>
        <div class="card-body">
            <form method='POST' action="/posts/{{ $post->id }}/comments">
                @csrf
                <input type='hidden' name='post_id' value="{{ $post->id }}"  />
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group">
                    <label for="text">コメント入力</label>
                    <textarea name='text' class="form-control"rows="10"></textarea>
                </div>
                <button type='submit' class="btn btn-primary btn-lg">コメント投稿</button>
            </form>
        </div>
    </div>
</div>
@endsection