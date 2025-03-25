@extends('layouts.app')

@section('title', "Create Product")

@section('content')
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 pl-10">
                                <a href="{{route('products.index')}}" class="btn btn-secondary mb-3 col-2"><i class="bi bi-arrow-left"></i> Back</a>
                                <form action="{{route('products.store')}}" method="POST">
                                    @csrf
                                    <legend>Create Product</legend>
                                    <div class="mb-3">
                                        <label for="productTitle" class="form-label">Name</label>
                                        <input type="text" name="title" class="form-control border-dark" value="{{ old('title') }}" id="productTitle" aria-describedby="productTitle" required>
                                    </div>
                                    @error('title')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-3">
                                        <label for="productPrice" class="form-label">Price</label>
                                        <input type="number" step="0.01" name="price" class="form-control border-dark" value="{{ old('price') }}" id="productPrice" aria-describedby="productPrice" required>
                                    </div>
                                    @error('price')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-3">
                                        <label for="productCurrencyId" class="form-label">Name</label>
                                        <select name="currency_id" class="form-control border-dark" id="productCurrencyId" required>
                                            <option value="">Select Currency</option>
                                            @foreach($currencies as $currency)
                                                <option value="{{$currency->id}}">{{$currency->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('currency_id')
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
