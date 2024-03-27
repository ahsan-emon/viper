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
                    Customer List
                </div>
                @if (Auth::user()->role == 2)
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <tr>
                                <td>Check</td>
                                <td>SL. No</td>
                                <td>Customer Name</td>
                                <td>Customer Email</td>
                                <td>Created At</td>
                                <td>Action</td>
                            </tr>
                            <form action="{{route('checkemailoffer')}}" method="POST">
                                @csrf
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="check[]" value="{{$user->id}}" class="form-control">
                                        </td>
                                        <td>{{$loop->index+1 }}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if ($user->created_at->diffInDays() > 30)
                                                {{$user->created_at}}
                                            @else
                                                <div class="badge badge-primary">
                                                    {{$user->created_at->diffForHumans()}}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('singleemailoffer',$user->id)}}" class="btn btn-sm btn-success">Send</a>
                                        </td>
                                    </tr>
                                @endforeach
                                <td class="text-center">
                                    <button type="submit" class="btn btn-sm btn-info">Send Check</button>
                                </td>
                            </form>
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
