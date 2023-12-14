<div class="global-navbar">
    {{-- <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h1>Logo</h1>
            </div>
        </div>
    </div> --}}

    <nav class="navbar navbar-expand-lg navbar-dark bg-green">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Blog App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="/">Home</a>
        </li>
        {{-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> --}}
        @php
        $categories = App\Models\Category::where('navbar_status','0')->where('status','0')->get();
        @endphp
        @foreach ($categories as $cateitem)
            <li class="nav-item">
              <a class="nav-link" href="{{ url('blog/'.$cateitem->slug) }}">{{$cateitem->name}}</a>
            </li>
        @endforeach
        @if(Auth::check())
        <li class=""><a class= "nav-link btn-danger " href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
            </a>
        </li>
        <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
            @csrf
        </form>
        @endif



      </ul>
      {{-- <a href="{{url('/login')}}"  class="btn btn-sm float-end">Login</a>
      <a href="{{url('/register')}}" style="margin-left: 12px" class="btn btn-sm float-end">Register</a> --}}
    </div>
  </div>
</nav>
</div>
