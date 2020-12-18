@extends("layouts.app")
@section("content")
   <div class="container">
        <h2 class="mb-4">Create post</h2>
        <form action="{{ url('/posts/add/confirm') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Enter Title" class="form-control mt-2" required>
            </div>
            <div class="form-group ">
                <label for="desctiption">Description</label>
                <textarea name="desctiption" id="desctiption" placeholder="Enter Description" class="form-control mt-2 " required></textarea>
            </div>
            <input type="submit" class="btn btn-success mt-2 mr-2" value="Confirm"></input>
            <button class="btn btn-danger mt-2">Clear</button>
        </form>
   </div>
@endsection