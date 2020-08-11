@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
            <th>
                 <a type="button" class="btn btn-success" href="{{route('post-create')}}">Create New</a>
            </th>
            <th>
                 <a type="button" class="btn btn-secondary" href="{{route('post-trashed')}}">Trashed Posts</a>
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
                Category
            </th>
            <th>
                Tags
            </th>
            <th>
                Action
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
                        {{$post->category->name}}
                    </td>
                    <td>
                        @foreach($post->tags as $tag)
                            {{ '#' . $tag->tag}}
                        @endforeach
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle btn-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item btn sm " href="{{route('post-delete',['id' => $post->id])}}">Trash</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item btn sm " href="{{route('post-edit',['id' => $post->id])}}">Edit</a>
                            </div>
                        </div>
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
                                No published posts. 
                            </h3>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
