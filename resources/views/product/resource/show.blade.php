@extends('layouts.main')

@section('title', "View Post")

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
                                <form>
                                    <fieldset disabled>
                                        <legend>View Post</legend>
                                        <div class="mb-3">
                                            <label for="postTitle" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control border-dark" value="{{$item->name}}" id="postTitle" aria-describedby="postTitle" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="postSlug" class="form-label">Slug</label>
                                            <input type="text" class="form-control border-dark" value="{{$item->slug }}" id="postTitle" name="slug" aria-describedby="postSlug" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="postContent" class="form-label">Content</label>
                                            <textarea class="form-control border-dark" id="postContent" name="content" rows="3" required>{{$item->content}}</textarea>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
