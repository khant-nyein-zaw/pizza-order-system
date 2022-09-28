@extends('admin.layouts.master')

@section('title', 'Pizza Create Page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Add new pizza</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="control-label mb-1">Name</label>
                                <input name="productName" type="text"
                                    class="form-control @error('productName') is-invalid @enderror"
                                    value="{{ old('productName') }}" placeholder="Enter product name">
                                @error('productName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label mb-1">Category</label>
                                <select name="productCategory"
                                    class="form-select @error('productCategory') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('productCategory')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label mb-1">Description</label>
                                <textarea name="productDescription" class="form-control @error('productDescription') is-invalid @enderror"
                                    cols="30" rows="10" placeholder="Enter description">{{ old('productDescription') }}</textarea>
                                @error('productDescription')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label mb-1">Pizza Photo</label>
                                <input type="file" name="productImage"
                                    class="form-control @error('productImage') is-invalid @enderror">
                                @error('productImage')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label mb-1">Waiting Time</label>
                                <input name="productWaitingTime" type="number"
                                    class="form-control @error('productWaitingTime') is-invalid @enderror"
                                    value="{{ old('productWaitingTime') }}" placeholder="Enter WaitingTime">
                                @error('productWaitingTime')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label class="control-label mb-1">Price</label>
                                <input name="productPrice" type="number"
                                    class="form-control @error('productPrice') is-invalid @enderror"
                                    value="{{ old('productPrice') }}" placeholder="Enter Price">
                                @error('productPrice')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
