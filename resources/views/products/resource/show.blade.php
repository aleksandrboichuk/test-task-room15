@extends('layouts.app')

@section('title', "View Product")

@section('content')
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 pl-10">
                                <a href="{{route('products.index')}}" class="btn btn-secondary mb-3 col-2"><i class="bi bi-arrow-left"></i> Back</a>
                                <form>
                                    <legend>View Product</legend>
                                    <div class="mb-3">
                                        <label for="productTitle" class="form-label">Title</label>
                                        <input readonly type="text" name="title" class="form-control border-dark" value="{{$item->title}}" id="productTitle" aria-describedby="productTitle" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="productPrice" class="form-label">Name</label>
                                        <input readonly type="number" step="0.01" name="price" class="form-control border-dark" value="{{$item->price}}" id="productPrice" aria-describedby="productPrice" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="productCurrencyId" class="form-label">Name</label>
                                        <select readonly name="currency_id" class="form-control border-dark" id="productCurrencyId" required>
                                            <option value="">Select Currency</option>
                                            @foreach($currencies as $currency)
                                                <option value="{{$currency->id}}" {{$currency->id != $item->currency_id ?: "selected"}}>{{$currency->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
