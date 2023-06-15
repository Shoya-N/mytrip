@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                    <div class="card-list col-md-8 mx-auto">
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
                                        
                                        <h5 class="icon"><img src="{{ secure_asset('storage/icon/ハート.png') }}" alt="" height="25" width="25"></h5>
                                        <span>
        			                    	<a href='https://www.google.com/maps/search/?api=1&query={{ $trip->map }}'>
                                                <img src="{{ secure_asset('storage/icon/google_maps_new_logo_icon_159147.png') }}" alt="" height="25" width="25">
                                            </a>
        		                        </span>
                                        <p class="card-text">
                                            <td>{{ Str::limit($trip->body, 250) }}</td>
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                <div class="date">更新日
                                                   {{--{{ $post->updated_at->format('Y年m月d日') }} --}}
                                                </div>
                                            </small>
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> 
            </div> 
        </div>
    </div>
</div>
@endsection
