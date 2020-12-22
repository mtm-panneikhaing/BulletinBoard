@extends("layouts.app")
@section("content")
    <div class="container">
        <h2 class="mb-4">User Lists</h2>
        <div class="form-inline mb-3">
            <input type="text" placeholder="Name" class="form-control mr-2 mb-2 col-lg-2 col-md-4">
            <input type="text" placeholder="Email" class="form-control mr-2 mb-2 col-lg-2 col-md-4">
            <input type="text" placeholder="Create Form" class="form-control mb-2 mr-2 col-lg-2 col-md-4">
            <input type="text" placeholder="Create To" class="form-control mr-2 mb-2 col-lg-2 col-md-4">
            <button class="btn btn-success mr-2 mb-2  col-lg-1 col-md-2">Search</button>
            @if(Auth::user()->type == 0)
                <a href="/users/create" class="btn btn-success mr-2 mb-2 col-lg-1 col-md-2">Add</a>
            @endif
        </div>
        
        <table class="table table-striped">
            <tr>
                <th>Profile</th>
                <th>Name</th>
                <th class="float-right">Delete</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td> 
                        <img src="../images/{{ $user->profile }}" alt="This is image" class="rounded-circle" height="40" width="40">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td class="float-right"><a href="{{ url("users/delete/$user->id ") }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection