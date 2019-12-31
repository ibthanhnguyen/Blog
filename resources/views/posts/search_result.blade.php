@extends('layouts.main')

@section('content')
<div class="row mb-2 justify-content-end">
    <div class="col-4">
        <div class="sort-box float-right">
            <form class="form-inline">
                <div class="form-group">
                    <label for="inputSort" class="mr-2">Sort by created date:</label>
                    <select class="form-control inputSort" name="sort">
                        <option value="desc">Descending</option>
                        <option value="asc">Ascending</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>
<input type="hidden" value="{{ $key }}" id="inputKey">

<div class="row" id="infinite-scroll">
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

@endsection

@push('scripts')
    <script type="text/javascript">
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
        $(document).ready(function(){
            var key = $("input#inputKey").val();
            $(".inputSort option[value='" + key + "']").attr('selected','selected');
        });
    </script>
@endpush