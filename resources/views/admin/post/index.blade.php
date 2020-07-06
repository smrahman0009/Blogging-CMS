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
            @foreach($posts as $post)
            <tr>
                <td>
                    <img src="{{asset($post->featured)}}" alt="" width="200px" height="100px">
                </td>
                <td>
                    {{$post->title}}
                </td>
                <td>
                    <a href="{{route('category-delete',['id' => $post->id])}}" class="btn xs btn-info">
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
        </tbody>
    </table>
@endsection
