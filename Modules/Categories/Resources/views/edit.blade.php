@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show col-sm-4" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form method="post" action="{{ route('categories.update') }}">
            <div class="form-group">
                {{ csrf_field() }}
                <label for="name">Name</label>
                <input type="hidden" value="{{ $category->category_id }}" name="id">
                <input type="text" name="name" id="name" class="form-control col-sm-4{{ $errors->has('name') ? ' is-invalid' : '' }}" autofocus value="{{ $category->name }}">

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <a href="{{ route('categories.show') }}">
                <button type="button" class="btn btn-default col-sm-2">
                    Back
                </button>
            </a>
            <button dusk="update-category-button" type="submit" class="btn btn-primary col-sm-2">Update</button>
        </form>
    </div>
@endsection
