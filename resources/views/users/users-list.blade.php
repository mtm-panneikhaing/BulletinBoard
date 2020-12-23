@extends("layouts.app")
@section("content")
<div class="container">
    @if(session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif
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
            <th>Name</th>
            <th>Email</th>
            <th>Created User</th>
            <th>Phone</th>
            <th>Birth Date</th>
            <th>Address</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th class="float-right">Delete</th>
        </tr>
        @foreach($users as $user)
        @php
            $usertype = $user->type ;
            switch($usertype){
                case 0:
                    $type = "Admin";
                    break;
                case 1:
                    $type = "User";
                    break;
                case 2:
                    $type = "Visitor";
                    break;        
            }
        @endphp
        <tr>
            <td><a data-toggle="modal" data-target="#myModal" class="detail"
                data-id="{{ $user->id }}"
                data-name="{{ $user->name }}"
                data-profile="{{ $user->profile }}"
                data-type="{{ $type }}"
                data-email="{{ $user->email }}"
                data-phone="{{ $user->phone }}"
                data-dob="{{ $user->dob }}"
                data-address="{{ $user->address }}" >{{ $user->name }}</a>
            </td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->create_user_id }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->dob }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->created_at->format('yy-m-d') }}</td>
            <td>{{ $user->updated_at->format('yy-m-d') }}</td>
            <td class="float-right"><a href="{{ url("users/delete/$user->id")}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
        @endforeach
    </table>
      <!-- Modal -->
      <div class="modal flade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">User Detail</h4>    
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <img src="#profile" alt="" id="profile" width="100" height="100" class="center">
                        <h4 class="card-title text-center  mb-2" id="name"></h4>
                        <table id="classTable" class="table table-striped">
                            <tr>
                                <td>Email</td>
                                <td id="email"></td>
                            </tr>
                            <tr>
                                <td>type</td>
                                <td id="type"></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td id="phone"></td>
                            </tr>
                            <tr>
                                <td>Date Of Birth</td>
                                <td id="dob"></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td id="address"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            
            </div>
        </div>

</div>
<script>
    $(document).ready(function(){
        $(document).on("click", ".detail", function () {
            $image = $(this).data('profile')
            $(".modal-body #userId").text( $(this).data('id') );
            $(".modal-body #name").text( $(this).data('name') );
            $(".modal-body #email").text( $(this).data('email') );
            $(".modal-body #profile").attr('src',"/images/".$image);
            $(".modal-body #type").text( $(this).data('type') );
            $(".modal-body #phone").text( $(this).data('phone') );
            $(".modal-body #address").text( $(this).data('address') );
            $(".modal-body #dob").text( $(this).data('dob') );
        });
    });
   
</script>
@endsection