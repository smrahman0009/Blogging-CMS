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
            @foreach($categories as $category)
            <tr>
                <td>
                    {{$category->name}}
                </td>
                <td>
                    <a href="{{route('category-edit',$category->id)}}" class="btn xs btn-info">
                        <span class="glyphicon glyphicon-pencil">edit</span>
                    </a>
                </td>
                <td>
                    <a href="{{route('category-delete',['id' => $category->id])}}" class="btn xs btn-danger">
                        <span class="glyphicon glyphicon-trash">delete</span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
