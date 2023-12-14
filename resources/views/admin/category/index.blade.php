@extends('layouts.master')
@section('title','Category')
@section('content')

  <div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>View Category <a href="{{url('admin/add-category')}}" class="btn btn-primary btn-sm float-end">Add Category</a>
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
                document.getElementById('alertMessage').style.display = 'none';
            }, 3000); // 10000 milliseconds = 10 seconds
        </script>
    @endif

            <table id="myDataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category NAme</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                        <img src="{{asset('uploads/category/'.$item->image)}}" width="50px" height="50px" alt="">
                        </td>
                        <td>{{$item->navbar_status == '1' ? 'Hidden' : 'Shown'}}</td>
                        <td><a href="{{url("admin/edit-category/".$item->id)}}" class="btn btn-success">Edit</a></td>
                        <td><a href="{{url("admin/delete-category/".$item->id)}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
  @endsection
