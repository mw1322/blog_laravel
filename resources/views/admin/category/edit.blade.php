@extends('layouts.master')
@section('title','Category')
@section('content')

  <div class="container-fluid px-1">
                        <div class="card mt-4">
                            <div class="card-header">
                            <h1 class="">Update Category</h1>
                            </div>
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
                                      document.getElementById('alertMessage').style.display = 'none';
                                  }, 5000); // 10000 milliseconds = 10 seconds
                              </script>

                                @endif
                                <form action="{{url('admin/update-category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="">Category Name</label>
                                        <input type="text" value={{$category->name}} name="name" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Slug</label>
                                        <input type="text" value={{$category->slug}} name="slug" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Description</label>
                                        <textarea id="mySummernote" rows="5"  name="description" class="form-control">{{$category->description}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Image</label>
                                        <input type="file" value={{$category->image}} name="image" class="form-control">
                                    </div>

                                    <h6>SEO Tags</h6>
                                    <div class="mb-3">
                                        <label for="">Meta Title</label>
                                        <input type="text" value = {{$category->meta_title}} name="meta_title" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Meta Description</label>
                                        <textarea name="meta_description"  rows="3" class="form-control">{{$category->meta_description}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Meta Keywords</label>
                                        <textarea name="meta_keyword"  rows="3" class="form-control">{{$category->meta_keyword}}</textarea>
                                    </div>

                                    <h6>Status Mode</h6>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label>Navbar Status</label>
                                            <input type="checkbox"  name="navbar_status" {{$category->navbar_status == '1' ? 'checked' : ''}}/>
                                        </div>
                                        {{-- <div class="col-md-3 mb-3">
                                            <label>Status</label>
                                            <input type="checkbox" name="status" {{$category->status == '1' ? 'checked' : ''}}/>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary">Update Category</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
  </div>
  @endsection
