@extends('layouts.main')
@section('content')
    <div class="content mb-3">
        <form action="{{ route('user.createPost') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="inputTitle">Title</label>
                <input type="text" class="form-control" id="inputTitle" name="title">
            </div>
            <div class="form-group">
                <label for="inputCate">Categories</label>
                <select id="inputCate" class="form-control" name="category_id">
                    <option selected>Choose category</option>
                    @forelse ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @empty
                        <option selected>No Data</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group">
                <label for="inputImage">Image file input</label>
                <input type="file" class="form-control-file" id="inputImage" name="image">
            </div>
            <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea class="form-control" id="inputDescription" rows="5" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="inputContent">Content</label>
                <textarea class="form-control" id="inputContent" rows="5" name="content"></textarea>
                <script>
                        CKEDITOR.replace( 'content' );
                </script>
            </div>
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
    </div>
@endsection
