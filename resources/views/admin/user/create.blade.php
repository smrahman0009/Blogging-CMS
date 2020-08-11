@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('user-store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name')is-invalid @enderror">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>                      
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection