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

        <div class="float-right">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Add
            </a>
        </div>

        <table class="table table-dark table-hover">
            <thead>
            <tr class="d-flex">
                <th class="col-3">Id</th>
                <th class="col-7">Name</th>
                <th class="col-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
            <tr class="d-flex">
                <td class="col-sm-3">{{ $category->category_id }}</td>
                <td class="col-sm-7">{{ $category->name }}</td>
                <td class="col-sm-2">
                    <a href="{{ route('categories.destroy', $category->category_id) }}" class="fa fa-trash"></a>
                    <a href="{{ route('categories.edit', $category->category_id) }}" class="fa fa-pencil"></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
