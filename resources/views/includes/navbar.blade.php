{{--
<nav class="navbar-laravel navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">First APP</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/home">Home</a></li>
            <li><a href="/about">About us</a></li>
            <li><a href="/services">Services</a></li>
            <li><a href="/posts">Posts</a></li>
            <li><a href="/posts/create">Create New Post</a></li>

        </ul>
    </div>
</nav>
--}}
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">First APP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <li> <a class="nav-item nav-link active" href="{{url('/home')}}"> Home <span class="sr-only">(current)</span></a></li>
            <li> <a class="nav-item nav-link" href="{{url('/about')}}">About</a></li>
            <li> <a class="nav-item nav-link" href="{{url('/services')}}">Services</a></li>
            <li> <a class="nav-item nav-link" href="{{url('/posts')}}">Posts</a></li>
            @auth
            <li> <a class=" btn btn-primary" href="{{url('/posts/create')}}">Create a Post</a> </li>
            @endauth
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto float-right">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/dashboard"> Dashboard</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
        </ul>
    </div>
</nav>