@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
        <div class="card-header">俳句検索</div>
            <div class="card-body">
                <form action="{{route('search')}}">
                    <div class="d-flex justify-content-center">
                        <input class="form-control form-control-lg border border-primary rounded-pill" type="text" placeholder="キーワード検索" aria-label="Search" name="keyword">
                        <input class="btn btn-primary btn-lg rounded-pill" type="submit" value="検索">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
