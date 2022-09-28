@extends('admin.layouts.master')

@section('title', 'Pizza Edit Page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('product#list', $product->id) }}">
                        <button class="btn bg-dark text-white my-3">
                            <i class="fa-solid fa-circle-chevron-left me-2"></i> Back
                        </button>
                    </a>
                </div>
            </div>
            <form action="{{ route('product#edit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-uppercase fw-bold text-center">
                            edit your product info here
                        </h3>
                    </div>
                    <div class="row g-0 p-3">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="w-100 my-3 rounded rounded-circle img-fluid">
                                <input type="file" name="productImage"
                                    class="form-control @error('productImage') is-invalid @enderror">
                                @error('productImage')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-outline-dark">
                                    Update
                                </button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input name="productName" type="text"
                                        class="form-control @error('productName') is-invalid @enderror"
                                        value="{{ old('productName', $product->name) }}" placeholder="Enter pizza name">
                                    @error('productName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Category</label>
                                    <select name="productCategory"
                                        class="form-select @error('productCategory') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('productCategory')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Description</label>
                                    <textarea name="productDescription" class="form-control @error('productDescription') is-invalid @enderror"
                                        cols="30" rows="10" placeholder="Enter description">{{ old('productDescription', $product->description) }}</textarea>
                                    @error('productDescription')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Price</label>
                                    <input name="productPrice" type="number"
                                        class="form-control @error('productPrice') is-invalid @enderror"
                                        value="{{ old('productPrice', $product->price) }}" placeholder="Enter Price">
                                    @error('productPrice')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Waiting Time</label>
                                    <input name="productWaitingTime" type="number"
                                        class="form-control @error('productWaitingTime') is-invalid @enderror"
                                        value="{{ old('productWaitingTime', $product->waiting_time) }}"
                                        placeholder="Enter WaitingTime">
                                    @error('productWaitingTime')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">View Count</label>
                                    <input type="text" class="form-control" value="{{ $product->view_count }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Date of creation</label>
                                    <input type="text" class="form-control"
                                        value="{{ $product->created_at->format('M j Y') }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
