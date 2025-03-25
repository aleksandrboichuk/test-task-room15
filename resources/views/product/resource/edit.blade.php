@extends('layouts.main')

@section('title', "Edit Post")

@section('content')
    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 pl-10">
                                <a href="{{route('product.index')}}" class="btn btn-secondary mb-3 col-2"><i class="bi bi-arrow-left"></i> Back</a>
                                <form action="{{route('product.update', [$item->id])}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <legend>Edit Post</legend>
                                    <div class="mb-3">
                                        <label for="postTitle" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control border-dark" value="{{$item->name}}" id="postTitle" aria-describedby="postTitle" required>
                                    </div>
                                    @error('title')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-3">
                                        <label for="postSlug" class="form-label">Slug</label>
                                        <input type="text" class="form-control border-dark" value="{{$item->slug }}" id="postTitle" name="slug" aria-describedby="postSlug" required>
                                    </div>
                                    @error('slug')
                                        <div class="form-text text-danger" >{{ $message }}</div>
                                    @enderror
                                    <div class="mb-3">
                                        <label for="postContent" class="form-label">Content</label>
                                        <textarea class="form-control border-dark" id="postContent" name="content" rows="3" required>{{$item->content}}</textarea>
                                    </div>
                                    @error('content')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror

                                    @error('system')
                                    <div id="inputEmail" class="form-text text-danger mb-3">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
