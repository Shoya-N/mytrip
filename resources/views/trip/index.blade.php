@extends('layouts.app')
@section('title', 'ホーム画面')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="row">
                <div class="col-3 offset-2">
                    <img src="{{ secure_asset('storage/icon/icon.png') }}" alt="" height="150" width="150">
                </div>
                <div class="col-2">
                    <h2>{{ Auth::user()->name }}</h2>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-light" href="#">
                    {{ __('messages.profilesettings') }}
                    </button>
                </div>
                
                {{-- カードの中身 --}}
                <div class="row">
                    <div class="card-list col-md-8 mx-auto">
                        @foreach($posts as $trip)
                            <div class="row">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        
                                        <div class="icon">
                                            <img src="{{ secure_asset('storage/icon/icon.png') }}" alt="" height="30" width="30">
                                            <span>{{ Auth::user()->name }}</span>
                                            <span>
                                                <div class="nav-item dropdown">
                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                        ・・・
                                                    </a>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('trip.edit', ['id' => $trip->id]) }}">編集</a>
                                                <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('trip.delete', ['id' => $trip->id]) }}">削除</a>
                                                </div>
                                                </div>
                                            </span>
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
@endsection