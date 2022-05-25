@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        <div class="card-header d-flex justify-content-between">
            @if (Auth::id() == $user['id'])
                マイページ
            @else
                ユーザー情報
            @endif
        </div>
        <div class="card-body">
            <div class="border border-primary rounded-pill text-center">
                <h1 class="username pt-3">{{ $user['name'] }}</h1>
                <p class="profile p-3">{{ $user['profile'] }}</p>
            </div>
            
            <h2 class="pt-3 text-center fw-bold">🖌作品集🖌</h2>
            <!-- ユーザーの投稿したコンテンツ -->
        @foreach($user->posts as $post)
            <div class="card-body border border-bottom">
                <div class="card-body">
                    <img src="{{ '/storage/' . $post['image']}}" class='w-100 mb-3'/>
                    <div class="d-flex justify-content-center">
                        <h1 class="ku">{{ $post['ku'] }}</h2>
                    </div>
                    <p class="description p-3">{{ $post['description'] }}</p>
                </div>
            </div>
        @endforeach 
            <!-- /対象のコンテンツ -->
        </div>
    </div>
</div>
@endsection
