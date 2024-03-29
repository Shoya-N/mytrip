@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
                <div class="card-list col-md-6 mx-auto">
                    @foreach($posts as $trip)
                        <div class="row">
                            <div class="card bg-light">
                                <div class="card-body">
                                    
                                    <div class="icon">
                                        <img src="{{ secure_asset('storage/icon/icon.png') }}" alt="" height="30" width="30">
                                        <span>{{ $trip->user->name }}</span>
                                    </div>
                                    
                                    <div class="photo">
                                        <img src="{{ secure_asset('storage/image/'. $trip->image_path) }}" alt="" height="350" width="480">
                                    </div>
                                    <div class="btn-group d-flex justify-content-between">
                                        @if(Auth::id() !=$trip->user_id)
                                            @if(Auth::user()->islike($trip->id))
                                                {!! Form::open(['route' => ['unlike', $trip->id], 'method' => 'delete']) !!}
                                                    {!! Form::submit('いいね！を外す', ['class' => "button btn btn-warning"]) !!}
                                                {!! Form::close() !!}
                                            @else
                                                {!! Form::open(['route' => ['like', $trip->id]]) !!}
                                                    {!! Form::submit('いいね！をつける', ['class' => "button btn btn-success"]) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        @endif
                                        <div>
        			                    	<a href='https://www.google.com/maps/search/?api=1&query={{ $trip->map }}'>
                                                <img src="{{ secure_asset('storage/icon/google_maps_new_logo_icon_159147.png') }}" alt="" height="25" width="25">
                                            </a>
        		                        </div>
        		                    </div>
                                    <p class="card-text">
                                        <td>{{ Str::limit($trip->body, 250) }}</td>
                                    </p>
                                    <small class="text-muted">
                                        <div class="date">更新日
                                           {{ $trip->updated_at->format('Y年m月d日') }} 
                                        </div>
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> 
        </div> 
    </div>
</div>
@endsection
