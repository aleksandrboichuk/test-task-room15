@extends('layouts.main')

@section('title', "Posts")

@section('content')
    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-10">
                                <h2 class="text-center">Posts</h2>
                                <a href="{{route('product.create')}}" class="btn btn-primary w-15 mb-4">Create Post</a>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Article Name</th>
                                        <th scope="col">Author</th>
                                        <th scope="col" class="col-3">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <th scope="row">{{$item->id}}</th>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->author ? $item->author->name : $item->created_by}}</td>
                                            <td class="text-center">
                                               <div class="inline">
                                                   <form action="{{route('product.destroy', [$item->id])}}" method="POST">
                                                       @csrf
                                                       @method("DELETE")
                                                       <a class="btn btn-primary" href="{{route('product.show', [$item->id])}}">
                                                           <i class="bi bi-eye"></i>
                                                       </a>
                                                       <a class="btn btn-success" href="{{route('product.edit', [$item->id])}}">
                                                           <i class="bi bi-pen"></i>
                                                       </a>
                                                       <button type="submit" class="btn btn-danger">
                                                           <i class="bi bi-trash"></i>
                                                       </button>
                                                   </form>
                                               </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
