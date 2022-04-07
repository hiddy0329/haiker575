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
        </div>
    </div>
</div>
@endsection
