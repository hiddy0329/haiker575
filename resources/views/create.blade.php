@extends('layouts.app')

@section('content')

<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        @include('errors')
        <div class="card-header">新規投句</div>
        <div class="card-body">
            <form method='POST' action="/store">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group">
                    <label for="ku">俳句</label>
                    <input name='ku' type="text" class="form-control" id="ku" placeholder="一句入力">
                </div>
                <div class="form-group">
                    <label for="description">説明文</label>
                    <textarea name='description' class="form-control"rows="10"></textarea>
                </div>
                <button type='submit' class="btn btn-primary btn-lg">投句</button>
            </form>
        </div>
    </div>
</div>
@endsection
