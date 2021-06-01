<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Integer;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(){
        $data = request() -> validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $authUser = auth()->user();
        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        
        $authUser->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . $authUser->id);
    }

    public function show(Post $post){
        $authUser = auth()->user();
        $likes = ($authUser) ? $authUser->likes->contains($post): false;
        $likesCount = $post->likes->count();

        return(view('posts.show', compact(['post', 'likes', 'likesCount'])));
    }

    public function destroy(Post $post){
        //$this->authorize('destroy', $post);
        $post->delete();
        return redirect('/profile/'.$post->user->profile->id);
    }
}
