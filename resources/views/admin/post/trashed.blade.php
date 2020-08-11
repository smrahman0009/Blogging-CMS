@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
            <th>
                 <a type="button" class="btn btn-secondary" href="{{route('posts')}}">Posts</a>
            </th>
        </thead>
        <thead>
            <th>
                Imgae
            </th>
            <th>
                Title
            </th>
            <th>
                Restore
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
                        <a href="{{route('post-restore',['id' => $post->id])}}" class="btn xs btn-success">
                            <span class="glyphicon glyphicon-trash">Restore</span>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('post-kill',['id' => $post->id])}}" class="btn xs btn-danger">
                            <span class="glyphicon glyphicon-trash">Delete</span>
                        </a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td>
                        {{$posts->links()}}
                    </td>
                </tr>
            @else
            <tr>
                <td colspan="4">
                        <h3 class="text-center">
                            No trashed posts. 
                        </h3>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
@endsection
