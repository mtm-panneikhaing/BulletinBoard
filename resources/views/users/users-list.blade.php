@extends("layouts.app")
@section("content")
    <div class="container">
        <h2 class="mb-4">User Lists</h2>
        <div class="form-inline mb-3">
            <input type="text" placeholder="Name" class="form-control mr-2">
            <input type="text" placeholder="Email" class="form-control mr-2">
            <input type="text" placeholder="Create Form" class="form-control mr-2">
            <input type="text" placeholder="Create To" class="form-control mr-4">
            <button class="btn btn-success ml-2">Search</button>
            <button class="btn btn-success ml-2">Add</button>
        </div>
        <ul class="list-group">
            <li class="list-group-item" data-toggle="modal" data-target="#myModal">
                <img src="../images/dog.jpg" alt="This is image" class="rounded-circle" height="40" width="40"
                >
                Name
                <!-- Delete User -->
                <a href="{{ url('/users/delete') }}" class="float-right">Delete</a>
            </li>
            <!-- The Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Pann Ei Khaing</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                      <table class="table table-striped">
                        <tr>
                            <td>Phone No</td>
                            <td>097777777</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>pann@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Birth Date</td>
                            <td>6 August</td>
                        </tr>
                        <tr>
                            <td>Created Date</td>
                            <td>6 August</td>
                        </tr>
                        <tr>
                            <td>Updated Date</td>
                            <td>6 August</td>
                        </tr>
                      </table>
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    
                </div>
                </div>
            </div>
  
        </ul>
    </div>
@endsection