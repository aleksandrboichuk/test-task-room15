@extends('layouts.app')

@section('title', "Products")

@section('content')
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-10">
                                <h2 class="text-center">Products</h2>
                                <a href="{{route('products.create')}}" class="btn btn-primary w-15 mb-4">Create Product</a>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Price</th>
                                        <th scope="col" class="col-3">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <th scope="row">{{$item->id}}</th>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->price}}</td>
                                            <td class="text-center">
                                               <div class="inline">
                                                   <form action="{{route('products.destroy', [$item->id])}}" method="POST">
                                                       @csrf
                                                       @method("DELETE")
                                                       <a class="btn btn-primary" href="{{route('products.show', [$item->id])}}">View</a>
                                                       <a class="btn btn-success" href="{{route('products.edit', [$item->id])}}">Edit</a>
                                                       <button type="submit" class="btn btn-danger">Delete</button>
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
