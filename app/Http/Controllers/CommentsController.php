<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$comments = Comment::orderBy('id', 'desc');
        $posts = Post::orderBy('id', 'desc');
        return view('posts.show', $comments );*/

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(  Request $request , $id)
    {
        //dd($request);
        //
        $request->validate([
            'body'=>'required',
        ]);
        $post = Post::find($id);
       //dd($post);
        // $posts = $post -> id;
        $comments = new Comment();
        $comments-> body = $request-> body;
        $comments -> user_id = auth() -> user() -> id;
        $comments -> post_id = $post->id;

        $comments -> save();
      //  $comments = Comment::orderBy('id', 'desc')->paginate(6);
        return redirect()->route('posts.show' , $post -> id );
      //  return view('posts.show' ,compact('comments', 'post'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $comment = Comment::find($id);
        return view('posts.comments_edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'body'=>'required',
        ]);
        $comments = Comment::find($id);
        $post = Post::where('id','=', $comments->post_id )->find($comments->post_id);

        $comments-> body = $request-> body;
        $comments -> user_id = auth() -> user() -> id;
        $comments -> post_id = $post->id;

        $comments -> save();


        return redirect()->route('posts.show' , $post -> id );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
        $comment = Comment::find($id);
        $comment -> delete();
        return back()->with('status','Comment was deleted');
    }
}
