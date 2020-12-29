@extends("layouts.app")
@section("content")
     <div class="container mb-3">
        <h3 class="mb-3">Update Post Confirmation</h3>
        <form action="{{ url('/posts/update/modify') }}" method="post">
            @csrf
            <div class="form-row  mb-3 mt-5">
                <input type="hidden" name="id" value="{{ $posts->id }}" class="form-control"/>
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
            <div class="custom-control custom-switch mb-5">
            {{$posts->status}}
                @if( $posts->status == 1)
                    <input type="checkbox" class="custom-control-input mt-2" id="status" name="status" value="{{ $posts->status }}" checked>
                @elseif ($posts->status == 0)  
                    <input type="checkbox" class="custom-control-input mt-2" id="status" name="status" value="{{ $posts->status }}" >
                @endif  
                <label class="custom-control-label" for="status">Status {{ $posts->status }}</label>
            </div>
            <input type="submit" class="btn btn-primary" value="Create" id="submit">
            <a href="{{ url('/posts') }}" class="btn btn-danger ml-4"> Cancel</a>
        </form>
    </div>
    <script>
        if(document.getElementById("#status").value == 1){
            document.getElementByid("#status").checked;
        }
    </script>
@endsection