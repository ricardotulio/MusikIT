@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show col-sm-12" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show col-sm-12" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="float-right">
            <a dusk="add-product-button" href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Add
            </a>
        </div>

        <table id="products-table" class="table table-dark table-hover">
            <thead>
            <tr class="d-flex">
                <th class="col-1">Id</th>
                <th class="col-4">Name</th>
                <th class="col-3">Category</th>
                <th class="col-2">Price</th>
                <th class="col-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if ($products->count() > 0)
                @foreach($products as $product)
                <tr class="d-flex">
                    <td class="col-sm-1">{{ $product->product_id }}</td>
                    <td class="col-sm-4">{{ $product->name }}</td>
                    <td class="col-sm-3">{{ $product->category()->first()->name }}</td>
                    <td class="col-sm-2">{{ $product->price }}</td>
                    <td class="col-sm-2">
                        <a id="update-product-{{ $product->product_id }}" href="{{ route('products.edit', $product->product_id) }}" class="fa fa-pencil"></a>
                        <a id="delete-product-{{ $product->product_id }}" href="{{ route('products.destroy', $product->product_id) }}" class="fa fa-trash"></a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="d-flex">
                    <td class="col-sm-12" colspan="2">
                        There is no products yet =( <br>
                        <a href="{{ route('products.create') }}">
                            Register something amazing!
                        </a>
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
@endsection
