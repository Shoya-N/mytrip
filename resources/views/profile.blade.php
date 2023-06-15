@extends('layouts.app')

@section('content')
    <div class="card w-50 mx-auto m-5">
        <div class="card-body">
            <div class="pt-2">
                <p class="h3 border-bottom border-secondary pb-3">プロフィール編集</p>
            </div>
            <input type="hidden" name="_method" value="PUT">
            <div class="m-3">
                <div class="form-group pt-1">
                    <label>{{ __('messages.name') }}</label>
                    <input type="text" name="{{ Auth:: user()->name }}" class="form-control" id="name">
                    <span class="text-danger">{{$errors->first('name')}}</span>
                </div>
                <div class="form-group pt-2">
                    <label>{{ __('messages.email') }}</label>
                    <input type="email" name="{{ Auth:: user()->email }}" class="form-control" id="email">
                    <span class="text-danger">{{$errors->first('email')}}</span>
                </div>
                <div class="form-group pull-right">
                    <input type="submit" class="btn btn-primary" value="更新する">
                    
                </div>
            </div>
            
        </div>
    </div>
@endsection