@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
            <th>
                Imgae
            </th>
            <th>
                Email
            </th>
            <th>
                Permission
            </th>
            <th>
                Delete
            </th>
        </thead>
        <tbody>
            @if($users->count())
                @foreach($users as $user)
                <tr>
                    <td>
                        <img src="{{$user->profile->avatar ? asset($user->profile->avatar) : asset('uploads/profile/profile_male_2.png')}}" alt="" width="50px" height="50px" style="border-radius:10px">
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        @if($user->profile->is_admin)
                            <a href="{{route('user-edit',['id' => $user->id])}}" class="btn btn-sm btn-warning">
                                <span class="glyphicon glyphicon-trash">Remove Permission</span>
                            </a>
                        @else
                            <a href="{{route('user-edit',['id' => $user->id])}}" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-trash">Make Admin</span>
                            </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('user-delete',['id' => $user->id])}}" class="btn btn-sm btn-danger">
                            <span class="glyphicon glyphicon-trash">Delete</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">
                            <h3 class="text-center">
                                No Users. 
                            </h3>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
