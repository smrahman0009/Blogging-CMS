@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            My text
        </div>
        <div class="panel-body">
            <form action="{{route('user-profile-update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <Nabel for="name">Name</Nabel>
                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control @error('name')is-invalid @enderror">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>                      
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="{{$user->password}}" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                @if($user->avatar)

                <div class="form-group">
                    <label for="avatar">Current Avatar</label>
                    <div class="text-left">
                        <img src="{{asset($user->avatar)}}" class="rounded" alt="..." height="200px" width="200px" >
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror">
                    @error('avatar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="about">About</label>
                        <textarea name="about" id="about" cols="6" rows="6" class="form-control @error('avatar') is-invalid @enderror">
                            {{$user->about}}
                        </textarea>
                    @error('about')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="facebook">facebook</label>
                    <input type="text" name="facebook" id="facebook" value="{{$user->facebook}}" class="form-control @error('facebook') is-invalid @enderror">
                    @error('facebook')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gmail">gmail</label>
                    <input type="text" name="gmail" id="gmail" value="{{$user->gmail}}" class="form-control @error('gmail') is-invalid @enderror">
                    @error('gmail')
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