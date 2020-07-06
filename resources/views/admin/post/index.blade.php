@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
            <th>
                Imgae
            </th>
            <th>
                Title
            </th>
            <th>
                Edit
            </th>
            <th>
                Delete
            </th>
        </thead>
        <tbody>
            @if($posts->count())
                @foreach($posts as $post)
                <tr>
                    <td>
                        <img src="{{asset($post->featured)}}" alt="" width="200px" height="100px">
                    </td>
                    <td>
                        {{$post->title}}
                    </td>
                    <td>
                        <a href="{{route('post-edit',['id' => $post->id])}}" class="btn xs btn-info">
                            <span class="glyphicon glyphicon-trash">Edit</span>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('post-delete',['id' => $post->id])}}" class="btn xs btn-danger">
                            <span class="glyphicon glyphicon-trash">Trash</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">
                            <h3 class="text-center">
                                No published posts. 
                            </h3>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
