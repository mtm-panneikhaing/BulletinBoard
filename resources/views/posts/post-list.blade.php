@extends("layouts.app")
@section("content")
    <div class="container">
        <input type="text" class="mr-2" placeholder="Search">
        <a href="#" class="btn btn-primary mr-2">Search</a>
        <a href="{{url('/posts/add')}}" class="btn btn-primary mr-2">Add</a>
        <a href="#" class="btn btn-primary mr-2">Upload</a>
        <a href="#" class="btn btn-primary mr-2">Download</a>
        <table class="table table-striped mt-3">
            <tr>
                <th>Post Title</th>
                <th>Post Description</th>
                <th>Post Used</th>
                <th>Post Date</th>
                <th>Edit </th>
                <th>Delete</th>
            </tr>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>used</td>
                    <td>{{ $post->created_at->format('m/d/yy') }}</td>
                    <td><button class="btn btn-success btn-xs"><i class="fas fa-edit"></i> </button></td>
                    <td><button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                </tr>
            @endforeach
        </table>   
        <div class="row justify-content-center">{{ $posts->links() }}</div>
    </div>
@endsection