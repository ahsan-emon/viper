@extends('layouts.app')
@section('breadcrumb')
    <div class="page-title-box">
        <h4 class="page-title">Home</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item">Category</li>
            <li class="breadcrumb-item active">List Category</li>
        </ol>
    </div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    List Category
                </div>
                @if (Auth::user()->role == 2)
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-danger">
                            {{session('delete')}}
                        </div>
                    @endif
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Category Name</th>
                                    <th>Category Photo</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->category_name }}</td>
                                            <td><img width="50px" src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" alt="Category Photo"></td>
                                            <td>
                                                <a href="{{ route('category.show',$category->id) }}" class="btn btn-sm btn-secondary">
                                                    Show
                                                </a>
                                                <a href="{{ route('category.edit',$category->id) }}" class="btn btn-sm btn-primary mt-2 d-block">
                                                    Action
                                                </a>
                                                <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger mt-2">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
