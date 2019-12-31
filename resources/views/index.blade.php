@extends('layouts.main')
@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="row">
            <div class="col-md-12 px-0 p-4 p-md-5">
                <h1 class="display-4 font-italic">{{ $newPost->title }}</h1>
                <p class="lead my-3">{{ \Illuminate\Support\Str::words($newPost->description, 50,'....') }}</p>
                <p class="lead mb-0"><a href="{{ route('blog', ['id' => $newPost->id]) }}" class="font-weight-bold">Continue reading...</a></p>
            </div>
        </div>
    </div>

    <div class="row mb-2 justify-content-end">
        <div class="col-4">
            <div class="sort-box float-right">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="inputSort" class="mr-2">Sort by created date:</label>
                        <select class="form-control inputSort" name="sort">
                            <option value="desc" selected>Descending</option>
                            <option value="asc">Ascending</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="infinite-scroll">
        @foreach($posts->chunk(2) as $chunked_posts)
            <div class="row">
                @foreach($chunked_posts as $post)
                    <div class="col-md-6">
                        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250">
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
                @endforeach
            </div>
            
        
        @endforeach
        {{ $posts->links() }}    
    </div>
@endsection

@push('scripts')
    <script>
        $('select.inputSort').change(function() {
            $val = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ route('sort') }}',
                data: {'_token': '{{ csrf_token() }}', 'sort': $val},
                success: function(response){
                    window.location.replace(response);
                }
            });
        })
    </script>  
@endpush