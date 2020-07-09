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
                        <img src="{{asset($user->profile->avatar)}}" alt="" width="200px" height="100px" style="border-radius:10px">
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        <a href="{{route('user-edit',['id' => $user->id])}}" class="btn xs btn-info">
                            <span class="glyphicon glyphicon-trash">{{$user->profile->is_admin ? 'admin':'genereal'}}</span>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('user-delete',['id' => $user->id])}}" class="btn xs btn-danger">
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
