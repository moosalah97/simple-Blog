@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-9 offset-3">
            <h3> create post form </h3>
            <hr>

            <form action="{{route('posts.update', ['id' => $post->id])}}"  method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="{{$post-> title }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" placeholder="{{$post-> body }}" cols="30" rows="4" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <input type="file" name="coverImage" id="coverImage" class="form-control-file">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection