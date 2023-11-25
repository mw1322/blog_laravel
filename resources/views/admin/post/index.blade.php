@extends('layouts.master')
@section('title','Blog Dashboard')
@section('content')
    <div class="container-fluid px-4">

        <div class="card mt-4 ">
        <div class="card-header">
            <h4>View Posts
                <a href="{{url('admin/add-post')}}" class="btn btn-primary float-end">Add Posts</a>
            </h4>
        </div>
        <div class="card-body">
             @if(session('message'))
        <div id="alertMessage" class="alert alert-success">
            {{ session('message') }}
        </div>
        <script>
            // Automatically hide the alert after 10 seconds
            setTimeout(function() {
                document.getElementById('alertMessage').style.display = 'none'
            }, 3000); // 10000 milliseconds = 10 seconds
        </script>
    @endif
            <table id="myDataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Post</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->status == '1' ? 'Hidden' : 'Visible'}}</td>
                        <td><a href="{{url("admin/edit-post/$item->id")}}" class="btn btn-success">Edit</a></td>
                        <td><a href="{{url("admin/delete-post/$item->id")}}" class="btn btn-danger">Delete</a></td>
            </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
