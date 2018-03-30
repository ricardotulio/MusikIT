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

        <form method="post" action="{{ route('categories.store') }}">
            <div class="form-group">
                {{ csrf_field() }}
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control col-sm-4{{ $errors->has('name') ? ' is-invalid' : '' }}" autofocus placeholder="Category Name">

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <a href="{{ route('categories.show') }}">
                <button dusk="back-button" type="button" class="btn btn-default col-sm-2">
                    Back
                </button>
            </a>
            <button dusk="create-category-button" type="submit" class="btn btn-primary col-sm-2">Create</button>
        </form>
    </div>
@endsection
