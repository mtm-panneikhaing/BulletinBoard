@extends("layouts.app")
@section("content")
    <div class="container">
        <h2 class="mb-4">Update Post </h2>
        <form action="url('update')" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control mt-2">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" id="description" class="form-control mt-2" ></textarea>
            </div>
            <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input mt-2" id="status" checked>
                <label class="custom-control-label" for="status">Status</label>
            </div>
            </div>
            <input type="submit" value="update" class="btn btn-primary mt-2 mr-2">
            <input type="reset" value="Clear" id="clear" class="btn btn-danger mt-2">
            
        </form>

    </div>
@endsection