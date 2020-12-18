@extends("layouts.app")
@section("content")
    <div class="container">
        <div>
            
           
            <div class="row mb-4">
                <div class="col">
                    <h3>User profile</h3>
                </div>
                <div class="col">
                    <a href="{{ url('users/edit') }}" class="btn btn-primary center">Edit</a>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-9">
                    <div class="row mb-2">
                        <div class="col-3 ">Name </div>
                        <div class="col-6">
                            <!-- <div class="row"> -->
                                <div class="row mb-4">Pan ei</div>
                                <div class="row mb-4"><img src="../images/dog.jpg" alt="profile" style="width:100px; height:100px;"></div>
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">Email</div>
                        <div class="col-6">pann@gmail.com</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">Type</div>
                        <div class="col-6">User</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">Phone</div>
                        <div class="col-6">09790753070</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">Date Of Birth</div>
                        <div class="col-6">6/8/96</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">Address</div>
                        <div class="col-6">Tarmwe Yangon</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection