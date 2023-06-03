@extends('layouts.app')
@section('title', 'ホーム')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ホーム</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('trip.add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('trip.index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">コメント</label></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">画像</th>
                                <th width="50%">コメント</th>
                                <th width="20%">GoogleMap</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $trip)
                                <tr>
                                    <th>{{ $trip->id }}</th>
                                    <td>{{ Str::limit($trip->image, 100) }}</td>
                                    <td>{{ Str::limit($trip->body, 250) }}</td>
                                    <td>
                                        <a href='https://www.google.com/maps/search/?api=1&query={{ $trip->map }}'>map</a>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('trip.edit', ['id' => $trip->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('trip.delete', ['id' => $trip->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection