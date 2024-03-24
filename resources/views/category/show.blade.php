@extends('layouts.app')
@section('breadcrumb')
    <div class="page-title-box">
        <h4 class="page-title">Home</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item">Category</li>
            <li class="breadcrumb-item"><a href="{{route('category.index')}}">List Category</a></li>
            <li class="breadcrumb-item active">Show</li>
        </ol>
    </div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Show Category
                </div>
                @if (Auth::user()->role == 2)
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Category Name</th>
                                    <td>{{ $category->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Category Tagline</th>
                                    <td>{{ $category->category_tagline }}</td>
                                </tr>
                                <tr>
                                    <th>Category Photo</th>
                                    <td><img width="50px" src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" alt="Category Photo"></td>
                                </tr>
                                </thead>
                        </table>
                    </div>
                @else
                    <div class="alert alert-danger">
                        You're not allowed to see this page.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
