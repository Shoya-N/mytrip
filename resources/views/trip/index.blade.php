@extends('layouts.app')
@section('title', 'ホーム画面')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            
                <div class="col-3 offset-2">
                    <img src="{{ secure_asset('storage/icon/icon.png') }}" alt="" height="150" width="150">
                </div>
                <div class="col-2">
                    <h2>{{ Auth::user()->name }}</h2>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-light" href="{{ route('profile') }}"> {{-- {{ route('trip.profile') }} --}}
                    {{ __('messages.profilesettings') }}
                    </button>
                </div>
                
                {{-- カードの中身 --}}
                <div class="row">
                    <div class="card-list col-md-6 mx-auto">
                        @foreach($posts as $trip)
                            <div class="row">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="icon d-flex">
                                            <div>
                                                <img src="{{ secure_asset('storage/icon/icon.png') }}" alt="" height="30" width="30">
                                                <span>{{ Auth::user()->name }}</span>
                                            </div>
                                            <div class="nav-item dropdown ms-auto">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    ・・・
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('trip.edit', ['id' => $trip->id]) }}">編集</a>
                                                    <a class="dropdown-item" href="{{ route('trip.delete', ['id' => $trip->id]) }}">削除</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="photo">
                                            <img src="{{ secure_asset('storage/image/'. $trip->image_path) }}" alt="" height="350" width="480">
                                        </div>
                                        <div class="icon d-flex">
                                            <div class="me-auto">
                                                <img src="{{ secure_asset('storage/icon/ハート.png') }}" alt="" height="25" width="25">
                                            </div>
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
@endsection