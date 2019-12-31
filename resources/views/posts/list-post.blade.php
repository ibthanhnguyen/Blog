@extends('layouts.main')

@section('content')
    <div id="infinite-scroll">
        <div class="row">
            @forelse($posts as $post)
            <div class="col-12">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm" style="height: 200px">
                    <div class="col-8 p-4">
                        <strong class="d-inline-block mb-2 text-primary">{{ $post->category->name }}</strong>
                        <h3 class="mb-0">{{ $post->title }}</h3>
                        <div class="mb-1 text-muted">{{ $post->created_at->format('Y-m-d') }}</div>
                        <p class="card-text mb-auto">{{ \Illuminate\Support\Str::words($post->description, 15,'....') }}</p>
                        <a href="{{ route('blog', ['id' => $post->id]) }}" class="stretched-link">Continue reading</a>
                    </div>
                    <div class="col-4">
                        
                        <img src="/storage/images/{{ $post->image }}" width="100%" height="100%">
                    </div>
                </div>
            </div>
            @empty
                <p class="text-center font-weight-bold">No Result</p>
            @endforelse
            {{ $posts->links() }}
        </div>
    </div>
@endsection
