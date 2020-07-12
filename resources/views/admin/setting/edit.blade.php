@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Update Settings
        </div>
        <div class="panel-body">
            <form action="{{route('setting-update')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="site_name">Site Name</label>
                    <input type="text" name="site_name" id="site_name" class="form-control @error('site_name')is-invalid @enderror" value="{{$setting->site_name}}" >
                    @error('site_name')
                    <div class="alert alert-danger">{{ $message }}</div>                      
                    @enderror
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number" class="form-control @error('contact_number')is-invalid @enderror" value="{{$setting->contact_number}}" >
                    @error('contact_number')
                    <div class="alert alert-danger">{{ $message }}</div>                      
                    @enderror
                </div>
                <div class="form-group">
                    <label for="contact_email">Contact Email</label>
                    <input type="email" name="contact_email" id="contact_email" class="form-control @error('contact_email') is-invalid @enderror" value="{{$setting->contact_email}}" >
                    @error('contact_email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Contact Address</label>
                    <textarea name="address" id="address" cols="5" rows="10" class="form-control @error('content') is-invalid @enderror">{{$setting->address}}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection