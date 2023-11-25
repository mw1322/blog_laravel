@extends('layouts.app')
@section('title',"$category->meta_title")
@section('meta_description',"$category->meta_description")
@section('meta_keyword',"$category->meta_keyword")
@section('content')

<div class="py-4">
    <div class="container">
        <div  class="row">
            <div  class="col-md-9">

                <div class="category-heading ">
                    <h4>{{$category->name}}</h4>
                </div>
                @forelse ($post as $postitem)
                <div class="card card-shadow mt-4">
                    <div class="card-body">
                        <a href="{{url('blog/'.$category->slug.'/'.$postitem->slug)}}">
                        <h2 class="post-heading">{{$postitem->name}}</h2>
                        </a>
                        <h6>Posted On: {{$postitem->created_at->format('d-m-Y') }}
                        <span class="ms-3">Posted By: {{$postitem->user->name }}</span>
                    </h6>
                    </div>

                </div>
                @empty
                <div  class="card card-shadow mt-4">
                    <div  class="card-body">
                        <h2  class="post-heading">No Post Available</h2>
                    </div>
                </div>

                @endforelse
                <div style="margin-top: 12px" class="your-paginate">
                    {{$post->links()}}
                </div>

            </div>
            <div  class="col-md-3">
                <div style="background-color: black" class="border p-2">
                    <h4 style="color: aliceblue">Advertising Here</h4>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
