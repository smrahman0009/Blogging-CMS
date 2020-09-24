@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
            <th>
                @if(Auth::user()->post_permission)
                    <a type="button" class="btn btn-success" href="{{route('category-create')}}">Create New</a>
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
            @if($categories->count())
                @foreach($categories as $category)
                <tr>
                    <td>
                        {{$category->name}}
                    </td>
                    <td>
                        @if(Auth::user()->post_permission)
                            <a href="{{route('category-edit',$category->id)}}" class="btn xs btn-info">
                                <span class="glyphicon glyphicon-pencil">edit</span>
                            </a>
                        @else
                            <a href="#" data-toggle="modal" data-target="#warningModal" class="btn xs btn-info">
                                <span class="glyphicon glyphicon-pencil">edit</span>
                            </a>
                        @endif 
                    </td>
                    <td>
                        @if(Auth::user()->post_permission)
                            <a href="{{route('category-delete',['id' => $category->id])}}" class="btn xs btn-danger">
                                <span class="glyphicon glyphicon-trash">delete</span>
                            </a>
                        @else
                            <a href="#" data-toggle="modal" data-target="#warningModal" class="btn xs btn-danger">
                                <span class="glyphicon glyphicon-trash">delete</span>
                            </a>
                        @endif 
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td>
                        {{$categories->links()}}
                    </td>
                </tr>    
            @else
            <tr>
                <td colspan="3">
                        <h3 class="text-center">
                            No category is created. 
                        </h3>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
@endsection
