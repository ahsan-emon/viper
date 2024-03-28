@extends('layouts.app')
@section('breadcrumb')
    <div class="page-title-box">
        <h4 class="page-title">Home</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item">Category</li>
            <li class="breadcrumb-item active">Sub Category</li>
        </ol>
    </div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Add Sub Category
                </div>
                @if (Auth::user()->role == 2)
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    @if (session('exist'))
                        <div class="alert alert-danger">
                            {{session('exist')}}
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('subCategory.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category" class="form-label">Category Name</label>
                                <select class="form-control" name="category_id">
                                    <option value="" selected>Select a category</option>
                                    @foreach ($categories as $category)
                                        <option {{ (old('category_id') == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                  </select>
                                @error('category_id')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="subcategory" class="form-label">Subcategory Name</label>
                                <input type="text" name="subcategory_name" value="{{ old('subcategory_name') }}" class="form-control" id="subcategory" placeholder="Enter subcategory Name">
                                @error('subcategory_name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="subcategoryTag" class="form-label">Subcategory Tagline</label>
                                <input type="text" name="subcategory_tagline" value="{{ old('subcategory_tagline') }}" class="form-control" id="subcategoryTag" placeholder="Enter subcategory Tagline">
                                @error('subcategory_tagline')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <labelclass="form-label">Subcategory Image</labelclass=>
                                <input type="file" name="subcategory_photo" class="form-control">
                                @error('subcategory_photo')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Subcategory</button>
                        </form>
                    </div>
                @else
                    <div class="alert alert-danger">
                        You're not allowed to see this page.
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-header">
                    List Sub Category
                </div>
                @if (Auth::user()->role == 2)
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>SL No</th>
                                    <th>Category Name</th>
                                    <th>Subcategory Name</th>
                                    <th>Subcategory Tagline</th>
                                    <th>Subcategory Photo</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subcategories as $key => $subcategory)
                                        <tr>
                                            {{-- @php
                                                use App/Models/Category;
                                                $category = Category::find($subcategory->category_id)->get();
                                            @endphp
                                            <td>{{ $category->category_name }}</td> --}}
                                            <td>{{ $key + $subcategories->firstItem() }}</td>
                                            <td>{{ App\Models\Category::find($subcategory->category_id)->category_name }}</td>
                                            <td>{{ $subcategory->category_id }}</td>
                                            <td>{{ $subcategory->subcategory_name }}</td>
                                            <td>{{ $subcategory->subcategory_tagline }}</td>
                                            <td><img width="50px" src="{{ asset('uploads/subcategory_photos') }}/{{ $subcategory->subcategory_photo }}" alt="Category Photo"></td>
                                            <td>
                                                <a href="{{ route('subCategory.edit',$subcategory->id) }}" class="btn btn-sm btn-primary mt-2 d-block">
                                                    Edit
                                                </a>
                                                <form action="{{ route('subCategory.destroy',$subcategory->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger mt-2">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center text-danger">
                                            <td colspan="50">No Data To Show</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                        </table>
                        {{ $subcategories->links() }}
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
