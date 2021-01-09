@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-9 offset-3">
            <h3> edit the comment </h3>
            <hr>

            <form action="{{route('comment.update', ['id' => $comment->id])}}"  method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="body"> edit the comment </label>
                    <input type="text" name="body" id="body" placeholder="{{$comment->body}}" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection