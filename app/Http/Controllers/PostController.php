<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostController extends Controller
{
    //redirect to home page if user logged out and try to create or edit post
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show' );
    }

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(6);
        $count = Post::count();
        return view('posts.index' , compact('posts','count'));
    }

    public function show($id){
    $post = Post::find($id);
    $comments = Comment::orderBy('id', 'desc')->paginate(6);
        return view('posts.show', compact('post' , 'comments'));

    }
    public function create(){
    return view('posts.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'bail|required|max:255',
            'body' => 'required',
            'coverImage' => 'image|mimes:jpeg,png|max:1999'

        ]);
        if($request->hasFile('coverImage')){
            $file = $request->file('coverImage');
            $ext = $file -> getClientOriginalExtension();
            $filename = 'cover_image' . '_' . time() . '.' . $ext;
             $file->storeAs('public/coverImages', $filename);
        }else{
            $filename='noimage.png';
        }

        $post = new Post();
        $post-> title = $request-> title;
        $post-> body = $request-> body;
        $post-> image = $filename;
        $post-> user_id = auth() -> user() -> id;
        $post->save();

        return redirect('/dashboard')->with('status','Post was created !');
    }

    public function edit($id){
        $post = Post::find($id);
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', ' You are not authorized');
        }
        return view('posts.edit',compact('post'));
    }


    public function update(Request $request , $id){
        $request->validate([
            'title' => 'bail|required|max:255',
            'body' => 'required',
            'coverImage' => 'image|mimes:jpeg,png|max:1999'

        ]);
        if($request->hasFile('coverImage')){
            $file = $request->file('coverImage');
            $ext = $file -> getClientOriginalExtension();
            $filename = 'cover_image' . '_' . time() . '.' . $ext;
            $file->storeAs('public/coverImages', $filename);
        }else{
            $filename='noimage.png';
        }

        $post = Post::find($id);
        $post-> title = $request-> title;
        $post-> body = $request-> body;
        $post-> image = $filename;

        $post->save();

        return redirect('/posts')->with('status','Post was updated !');
    }

    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('status','Post was deleted');

    }

}