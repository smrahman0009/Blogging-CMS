@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
            <th>
                @if(Auth::user()->post_permission)
                    <a type="button" class="btn btn-success" href="{{route('tag-create')}}">Create New</a>
                @else
                    <a type="button" data-toggle="modal" data-target="#warningModal" class="btn btn-success" href="#">Create New</a>
                @endif
            </th>
        </thead>
        <thead>
            <th>
                Category
            </th>
            <th>
                Edit
            </th>
            <th>
                Delete
            </th>
        </thead>
        <tbody>
            @if($tags->count())
                @foreach($tags as $tag)
                <tr>
                    <td>
                        {{$tag->tag}}
                    </td>
                    <td>
                        @if(Auth::user()->post_permission)
                            <a href="{{route('tag-edit',$tag->id)}}" class="btn xs btn-info">
                                <span class="glyphicon glyphicon-pencil">edit</span>
                            </a>
                        @else
                            <a data-toggle="modal" data-target="#warningModal" href="#" class="btn xs btn-info">
                                <span class="glyphicon glyphicon-pencil">edit</span>
                            </a>
                        @endif
                    </td>
                    <td>
                        @if(Auth::user()->post_permission)
                            <a href="{{route('tag-delete',['id' => $tag->id])}}" class="btn xs btn-danger">
                                <span class="glyphicon glyphicon-trash">delete</span>
                            </a>
                        @else
                            <a data-toggle="modal" data-target="#warningModal" href="#" class="btn xs btn-danger">
                                <span class="glyphicon glyphicon-trash">delete</span>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td>
                        {{$tags->links()}}
                    </td>
                </tr>    
            @else
            <tr>
                <td colspan="3">
                        <h3 class="text-center">
                            No tag is created. 
                        </h3>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
@endsection
