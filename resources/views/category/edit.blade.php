@extends('layouts.app')
@section('breadcrumb')
    <div class="page-title-box">
        <h4 class="page-title">Home</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item">Category</li>
            <li class="breadcrumb-item active"><a href="{{route('category.index')}}">List Category</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Add Category
                </div>
                @if (Auth::user()->role == 2)
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="category" class="form-label">Category Name</label>
                                <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control" id="category" placeholder="Enter Category Name">
                                @error('category_name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="categoryTag" class="form-label">Category Tagline</label>
                                <input type="text" name="category_tagline" value="{{ $category->category_tagline }}" class="form-control" id="categoryTag" placeholder="Enter Category Tagline">
                                @error('category_tagline')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label d-block">Category Image</label>
                                <img class="img-fluid" width="300px" src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" alt="">
                                <input type="file" name="category_photo" class="form-control">
                                @error('category_photo')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Edit {{ $category->category_name }} Category</button>
                        </form>
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
