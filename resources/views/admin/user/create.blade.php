@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Create New User
        </div>
        <div class="panel-body">
            <form action="{{route('user-store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <Nabel for="name">Name</Nabel>
                    <input type="text" name="name" idd="name" class="form-control @error('name')is-invalid @enderror">
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