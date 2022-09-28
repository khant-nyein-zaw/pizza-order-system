@extends('admin.layouts.master')

@section('title', 'Pizza List Page')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- Creation success notification -->
                @if (session('createSuccess'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <strong>{{ session('createSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- Update success notification -->
                @if (session('updateSuccess'))
                    <div class="alert alert-info alert-dismissible fade show mt-2" role="alert">
                        <strong>{{ session('updateSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- Delete success notification -->
                @if (session('deleteSuccess'))
                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        <strong>{{ session('deleteSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('product#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="h4 pb-2 mb-4 text-primary border-bottom border-primary">
                        Total Products - {{ $products->total() }}
                    </div>
                    <form class="form-header" action="{{ route('product#list') }}" method="get">
                        @csrf
                        <input class="au-input au-input--xl" type="text" name="searchKey"
                            value="{{ request('searchKey') }}" placeholder="Search for Products..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
                @if (request('searchKey'))
                    <div class="float-right my-2">
                        <h3 class="text-uppercase">
                            Results of <span class="text-primary">{{ request('searchKey') }}</span>
                        </h3>
                    </div>
                @endif
                <!-- Looping Product Data -->
                @if (count($products) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="tr-shadow">
                                        <td class="col-md-4">
                                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid"
                                                style="width: 50%:">
                                        </td>
                                        <td class="col-md-2">{{ $product->name }}</td>
                                        <td class="col-md-2">{{ $product->category_name }}</td>
                                        <td class="col-md-2">{{ $product->created_at->format('M j Y') }}</td>
                                        <td class="col-md-2">
                                            <div class="table-data-feature">
                                                <a href="{{ route('product#view', $product->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#editPage', $product->id) }}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('product#delete', $product->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $products->links() }}
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading text-capitalize">No product found.</h4>
                        <hr>
                        <p class="mb-0">
                            Create something...
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
