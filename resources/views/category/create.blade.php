@extends('layouts.app')
@section('breadcrumb')
    <div class="page-title-box">
        <h4 class="page-title">Home</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Email Offer</li>
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
                        <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="category" placeholder="Enter Category Name">
                                @error('category_name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="categoryTag" class="form-label">Category Tagline</label>
                                <input type="text" name="category_tagline" class="form-control" id="categoryTag" placeholder="Enter Category Tagline">
                                @error('category_tagline')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <labelclass="form-label">Category Image</labelclass=>
                                <input type="file" name="category_photo" class="form-control">
                                @error('category_photo')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
