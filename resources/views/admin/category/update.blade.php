@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Update Category {{$category->name}}
        </div>
        <div class="panel-body">
            <form action="{{route('category-update',$category->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name="name" id="title" value="{{$category->name}}" class="form-control @error('name') is-invalid @enderror">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection