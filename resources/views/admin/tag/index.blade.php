@extends('layouts.app')

@section('content')
    <table class="table table-hover">
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
                        <a href="{{route('tag-edit',$tag->id)}}" class="btn xs btn-info">
                            <span class="glyphicon glyphicon-pencil">edit</span>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('tag-delete',['id' => $tag->id])}}" class="btn xs btn-danger">
                            <span class="glyphicon glyphicon-trash">delete</span>
                        </a>
                    </td>
                </tr>
                @endforeach    
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
