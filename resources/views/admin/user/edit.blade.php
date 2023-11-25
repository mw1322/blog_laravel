@extends('layouts.master')
@section('title','Category')
@section('content')

  <div class="container-fluid px-1">
                        <div class="card mt-4">

                            <div class="card-body">
                                @if($errors->any())
                                <div id="alertMessage" class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <div>{{$error}}</div>
                                    @endforeach
                                </div>
                                <script>
                                  // Automatically hide the alert after 10 seconds
                                  setTimeout(function() {
                                      document.getElementById('alertMessage').style.display = 'none'
                                  }, 5000); // 10000 milliseconds = 10 seconds
                              </script>

                                @endif
                                <div class="card-header">
                            <h1 class="">Update User
                                <a href="{{url("admin/users")}}" class="btn btn-danger float-end" >Back</a>
                            </h1>

                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="">Full Name</label>
                                    <p class="form-control">{{$user->name}}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="">Email Id</label>
                                    <p class="form-control">{{$user->email}}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="">Created At</label>
                                    <p class="form-control">{{$user->created_at->format('d/m/Y')}}</p>
                                </div>
                            <form action="{{url("admin/update-user/$user->id")}} " method = "POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="">Role as</label>
                                <select  name="role_as" id="" class="form-control mb-3">
                                    <option value="1" {{$user->role_as == '1' ? 'Selected' : ''}}>Admin</option>
                                    <option value="0" {{$user->role_as == '0' ? 'Selected' : ''}}>User</option>
                                    <option value="2" {{$user->role_as == '2' ? 'Selected' : ''}}>Blogger</option>
                                </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update Role of User</button>
                                </div>
                            </form>
                            </div>
                             </div>
                        </div>
  </div>
    @endsection
