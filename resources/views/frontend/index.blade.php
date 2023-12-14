@extends('layouts.app')
@section('title',"Manish Blog Website")
@section('meta_description',"Manish Blog Website")
@section('meta_keyword',"Manish Blog Website")

@section('content')

<div class="wrapper">
    @foreach ($category as $item)
    <ul class="carousel">
        <a href="{{url("blog/".$item->slug)}}">
        <li class="card">
            <div class="img"><img src="{{asset('uploads/category/'.$item->image)}}" width="40px" height="40px" alt=""></div>
            <h2>{{$item->name}}</h2>
            <span></span>
        </li>
        </a>
    </ul>
    @endforeach

    <div class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Blog Application</h4>
                <div class="underline"></div>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt accusantium ullam, error hic ea culpa! Commodi ut est corrupti fugiat. Non atque esse quaerat! Aspernatur eius ea totam obcaecati minus.</p>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
