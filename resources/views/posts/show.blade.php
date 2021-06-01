@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="{{asset('/storage/'.$post->image)}}" class="w-100">
            </div>
            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center">
                        <img src="{{asset($post->user->profile->profileImage())}}" style="max-width: 50px"
                             class="w-100 rounded-circle mr-3">
                        <div>
                            <div class="font-weight-bold">
                                <a href="/profile/{{$post->user->id}}">
                                    <span class="text-dark">{{$post->user->username}}</span>
                                </a>
                                @can('delete', $post)
                                    <form action="/p/{{$post->id}}"  enctype="multipart/form-data" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="text-danger" type="submit" value="Delete Post">
                                    </form>
                                @endcan
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
                    @auth
                        <div>
                            <like-count post-id="{{ $post->id }}" like="{{ $likes }}" like-count="{{ $likesCount }}"></like-count>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
