@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show col-sm-4" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show col-sm-4" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form method="post" action="{{ route('products.store') }}">
            <div class="form-group">
                {{ csrf_field() }}

                <label for="name">Name *</label>
                <input type="text" name="name" id="name" class="form-control col-sm-4{{ $errors->has('name') ? ' is-invalid' : '' }}" autofocus placeholder="Product Name">

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="category_id">Category *</label>
                <select class="form-control col-sm-4" name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option id="select-category-{{ $category->category_id }}" value="{{ $category->category_id }}">{{ $category->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price *</label>
                <input type="number" name="price" id="price" class="form-control col-sm-4{{ $errors->has('price') ? ' is-invalid' : '' }}" autofocus>

                @if ($errors->has('price'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="description"> Description (optional) </label>
                <textarea name="description" id="description" name="description" cols="30" rows="5" class="form-control col-sm-4">

                </textarea>
            </div>
            <a href="{{ route('products.show') }}">
                <button dusk="back-button" type="button" class="btn btn-default col-sm-2">
                    Back
                </button>
            </a>
            <button dusk="create-product-button" type="submit" class="btn btn-primary col-sm-2">Create</button>
        </form>
    </div>
@endsection
