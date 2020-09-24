@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
            <th>
                @if(Auth::user()->post_permission)
                    <a type="button" class="btn btn-success" href="{{route('post-create')}}">Create New</a>
                @else
                    <a type="button" data-toggle="modal" data-target="#warningModal" class="btn btn-success" href="#">Create New</a>
                @endif 
            </th>
            <th>
                @if(Auth::user()->post_permission)
                    <a type="button" class="btn btn-secondary" href="{{route('post-trashed')}}">Trashed Posts</a>
                @else
                    <a type="button" data-toggle="modal" data-target="#warningModal" class="btn btn-secondary" href="#">Trashed Posts</a>
                @endif 
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
                            <button type="button" class="btn dropdown-toggle btn-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" {{ !Auth::user()->post_permission ? 'disabled' : ''}}>
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
