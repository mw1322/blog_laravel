@extends('layouts.usermaster')
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
                            <h1 class="">Update Post
                                <a href="{{url("user/posts")}}" class="btn btn-danger float-end" >Back</a>
                            </h1>

                            </div>
                <form action="{{url('user/update-post/'.$post->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Category</label>
                    <select name="category_id" required class="form-control" id="">
                        <option value="">--Select Category--</option>
                        @foreach ($category as $cateitem)
                            <option value="{{$cateitem->id}}" {{$post->category_id == $cateitem->id ? "selected" : ""}}>{{$cateitem->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Post Name</label>
                    <input type="text" value="{{$post->name}}" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" value="{{$post->slug}}" name="slug" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea id="mySummernote" name="description" class="form-control" rows="4">{{$post->description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="">Youtube Iframe Link</label>
                    <input type="text" value="{{$post->yt_iframe}}" name="yt_iframe" class="form-control">
                </div>

                <h4>SEO Tags</h4>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" value="{{$post->meta_title}}" name="meta_title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3"> {{$post->meta_description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="">Meta Keyword</label>
                    <textarea name="meta_keyword" class="form-control" rows="3">{{$post->meta_keyword}}</textarea>
                </div>

                <h4>Status</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="">Status</label>
                            <input type="checkbox" name="status"  {{$post->status == '0' ? 'checked' : ""}}>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-end">Save Post</button>
                        </div>
                    </div>
                </div>
            </form>
                            </div>
                        </div>
  </div>
    @endsection

