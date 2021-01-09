@extends('layouts.app')

@section('content')
<div class="row">
    <div class="cal-md-9 offset-4">
        <div class="card mb-3" style="min-width: 18rem;">
            <div class="card-header bg-dark text-white">
                {{$post->title}}
            </div>
            <div class="card-body">
                <img src="{{asset('storage/coverimages/'.$post->image)}}" alt="mm" height="200" width="320">
                <div class="card-title">
                    <h4> {{$post->title}}</h4>
                </div>
                <div class="card-text">
                    {{$post->body}}
                </div>
                <hr>
                <small class="text-muted"><p>published at {{$post->created_at}}</p></small>
                <small class="text-muted"><p>created by: {{$post->user->name}}</p></small>
                @auth
                <form action="{{route('comments.store', ['id' => $post->id])}}" method="get" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="body">comment</label>
                        <textarea name="body" id="body" cols="30" rows="4" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">comment</button>
                    </div>
                                    </form>
                {{--<div class="row">
                    <textarea for="body" name="body" id="body" cols="30" rows="4" class="form-control">
                    </textarea>
                    <a href="{{ '/comment/' . $post->id }}" class="btn btn-primary float-left mr-2" > comment</a>

                </div>--}}

                <div class="row">


                    @if( auth()->user()->id == $post -> user_id)

                        <a href="{{ '/posts/' . $post->id . '/edit'}}" class="btn btn-primary float-left mr-2"> Edit</a>

                        <form action="{{route('posts.destroy', ['id' => $post->id])}}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger float-left"> Delete</button>

                        </form>
                        @endif
                    @endauth


                </div>

            </div>
        </div>
<div class="row card-text"><h4>   comments  </h4></div>
            @foreach( $comments as $comment)
            @if( $post->id == $comment-> post_id)
                <div class="card-header bg-dark text-white">
                    <small class="text-muted"><p>comment by: {{$comment->user->name}}</p></small>
                    {{$comment -> body}}
                    @auth
                    @if( auth()->user()->id == $comment -> user_id)
                    <div class="row float-right">
                        <a href="{{ '/posts/comments_edit/'. $comment->id }}" class="btn btn-primary float-left mr-2"> Edit</a>

                            <form action="{{route('comments.destroy', ['id' => $comment->id])}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger float-left"> Trash </button>

                            </form>
                    </div>
                    @endif
                    @endauth
                </div>
            @endif
            @endforeach

    </div>
</div>


@endsection