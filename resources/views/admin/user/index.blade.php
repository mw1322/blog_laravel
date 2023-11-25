@extends('layouts.master')
@section('title','View Users')
@section('content')
    <div class="container-fluid px-4">

        <div class="card mt-4 ">
        <div class="card-header">
            <h4>View Users
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
                        <th>Username</th>
                        <th>Role</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->role_as == '1' ? 'Admin' : 'User'}}</td>
                        <td><a href="{{url("admin/edit-user/$item->id")}}" class="btn btn-success">Edit</a></td>
                        {{-- <td><a href="{{url("admin/delete-post/$item->id")}}" class="btn btn-danger">Delete</a></td> --}}
            </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
