@extends('layouts.main')
@section('content')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-12 blog-main">
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $blog->title }}</h2>
                    <p class="blog-post-meta">Submitted {{ $blog->created_at->format('F d, Y') }} by {{ $blog->user->name }}</p>
                    <div class="content-box">
                        {!! $blog->content !!}
                    </div>
                </div>
                @if(Auth::check())
                    <div class="coment-box">
                        <form action="{{ route('user.comment', ['id' => $blog->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control" id="inputName" name="inputName" value="{{ Auth::user()->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <hr>
                        <div class="comments pt-3 pb-3">
                            @foreach($blog->comments as $comment)
                                <span class="font-weight-bold">{{{ $comment->user->name }}}</span>
                                <p class=”lead”>{{{ $comment->comment }}}</p>
                            
                            @endforeach
                        </div>
                    </div>
                @else
                    <p class="text-center font-weight-bold"><a href="{{ route('login') }}">Login</a> to write comment</p>
                @endif

            </div>
        </div>
    </main>
@endsection