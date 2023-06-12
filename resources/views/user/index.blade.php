@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($users as $user)
            <div>
                <div>{{$user->name}}</div>
                <button>フォローする</button>
            </div>
            @endforeach
        </div>
    </div>
 </div>
@endsection
