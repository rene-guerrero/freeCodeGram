@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="row">
                <div class="card mb-3">
                    <div class="card-body d-flex">
                        <div class="col-5">
                            <a href="/p/{{$post->id}}">
                                <img src="{{asset('/storage/'.$post->image)}}" class="w-100">
                            </a>
                        </div>
                        <div class="col-5">
                            <div>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset($post->user->profile->profileImage())}}" style="max-width: 50px"
                                         class="w-100 rounded-circle mr-3">
                                    <div>
                                        <div class="font-weight-bold">
                                            <a href="/profile/{{$post->user->id}}">
                                                <span class="text-dark">{{$post->user->username}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <p>
                                    <span class="font-weight-bold">
                                        <a href="/profile/{{$post->user->id}}">
                                            <span class="text-dark">{{$post->user->username}}</span>
                                        </a>
                                    </span>
                                    {{$post->caption}}
                                </p>
                                <div>
                                    <like-count post-id="{{ $post->id }}"
                                                like="{{ auth()->user()->likes->contains($post) }}"
                                                like-count="{{ $post->likes->count() }}"></like-count>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="m-auto">
                {{ $posts->links() }}
            </div>
        </div>
        <h3>Who to follow:</h3>
        <div class="row">
            @forelse(auth()->user()->suggestions() as $user)
                <div class="col-md-3">
                    <div class="card mb-3 shadow-sm" style="overflow: hidden; min-height: 250px;">
                        <div class="card-body d-flex">
                            <div class="w-100">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset($user->profile->profileImage())}}" style="max-width: 50px"
                                         class="w-100 rounded-circle mr-3">
                                    <div>
                                        <div class="font-weight-bold">
                                            <a href="/profile/{{$user->id}}">
                                                <span class="text-dark">{{$user->username}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <follow-button user-id="{{ $user->id }}" follows="{{ auth()->user()->follows($user) }}"></follow-button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <h4 class="text-danger">Looks like nobody else is registered. That's sad :(</h4>
                    <h4 class="text-success">Or maybe you have followed every single user, which is awesome!!</h4>
                </div>
            @endforelse

        </div>
    </div>
@endsection
