@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="form-group row">
            <input type="text" class="col-lg-3 col-md-12 ml-3 mr-2 mb-2" placeholder="Search">
            <a href="#" class="btn btn-primary col-lg-2 col-md-6 mr-2 mb-2">Search</a>
            @auth
                <a href="{{url("/posts/add")}}" class="btn btn-primary col-lg-2 col-md-6 mr-2 mb-2">Add</a>
                <a href="#" class="btn btn-primary col-lg-2 col-md-6 mr-2 mb-2">Upload</a>
                <a href="#" class="btn btn-primary col-lg-2 col-md-6 mr-2 mb-2">Download</a>
            @endauth
        </div>
        <table class="table table-striped mt-3 ">
            <tr>
                <th>Post Title</th>
                <th>Post Description</th>
                <th>Post Used</th>
                <th>Post Date</th>
                @auth
                    <th>Edit </th>
                    <th>Delete</th>
                @endauth
            </tr>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->user->name}}</td>
                    <td>{{ $post->created_at->format('m/d/yy') }}</td>
                    @auth
                        <td>
                            @if(Auth::user()->id == $post->create_user_id )
                                <a href="{{ url("posts/update/$post->id") }}" class="btn btn-success btn-xs"><i class="fas fa-edit"></i> </a>
                            @endif
                        </td>
                        <td>
                            @if(Auth::user()->id == $post->create_user_id )
                                <a href="{{ url("posts/delete/$post->id ") }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            @endif
                        </td>
                    @endauth
                </tr>
            </div>
            @endforeach
        </table>   
        <div class="row justify-content-center">{{ $posts->links() }}</div>
        <script>
            $(document).ready(function () {
                $(".deleteDialog").click(function () {
                $('#post').val($(this).data('id'));
                $('#addBookDialog').modal('show');
    });
});
        </script>
    </div>
@endsection