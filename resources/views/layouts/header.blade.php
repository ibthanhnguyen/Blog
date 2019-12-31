<header class="blog-header py-3">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Brand</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @foreach($categories as $cate)
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('cate', ['id' => $cate->id]) }}">{{ $cate->name }}</a>
                    </li>
                @endforeach   
            </ul>
            
            <ul class="navbar-nav">
                @if(Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.createNewPost') }}">Create post</a>
                        <a class="dropdown-item" href="{{ route('user.list-posts') }}">My posts</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/logout') }}">Log out</a>
                    </div>
                </li>
                @else  
                    <div class="col-4 d-flex justify-content-end align-items-center">
                        <a class="btn btn-sm btn-outline-secondary" href="/login">Login</a>
                    </div>
                @endif
            </ul>
        </div>
    </nav>
</header>