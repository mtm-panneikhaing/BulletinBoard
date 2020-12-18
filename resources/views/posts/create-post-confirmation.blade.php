@extends("layouts.app")
@section("content")
    <!-- {{ $posts->title }} -->
    <!-- <div class="container mb-3">
        <h3 >Create Post Confirmation</h3>
        <div class="row mb-3 mt-5">
            <div class="col-3"><b>Title</b></div>
            <div class="col"> {{ $posts->title }} </div>
        </div>
        <div class="row mb-5">
            <div class="col-3"><b>Description</b></div>
            <div class="col"> {{ $posts->description }} </div>
        </div>
        <a href="{{ url('/posts/add/confirm/insert') }}" class="btn btn-primary mr-4"><i class="fas fa-save"></i> Create</a>
        <a href="{{ url('/posts') }}" class="btn btn-danger ml-4"><i class="fas fa-window-close"></i> Cancel</a>
    </div> -->
    <!-- form method initialize -->
     <div class="container mb-3">
        <h3 class="mb-3">Create Post Confirmation</h3>
        <form action="{{ url('/posts/add/confirm/insert') }}" method="post">
            @csrf
            <div class="form-row  mb-3 mt-5">
                <div class="col-3">
                    <label for="title">Title</label>
                </div>
                <div class="col">
                    <input type="hidden" name="title" value="{{ $posts->title }}" class="form-control"/>
                    <label for="title">{{ $posts->title }}</label>
                </div>
            </div>
            <div class="form-row mb-5">
                <div class="col-3">
                    <label for="description">Description</label>
                </div>
                <div class="col">
                    <input type="hidden" name="description" value="{{ $posts->description }}" class="form-control"/>
                    <label for="description">{{ $posts->description }}</label>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Create">
            <a href="{{ url('/posts') }}" class="btn btn-danger ml-4"> Cancel</a>
        </form>
    </div>
@endsection