@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row ">
            <div class="col"><h3>Create User Confirmation</h3></div>
            <div class="col">
                <img src="../images/dog.jpg" alt="profile" style="width:100px; height:100px">
            </div>
        </div>
        <div class="col-6">
            <form action="{{ url('') }}" method="post">
                <div class="form-row">
                    <div class="col-3">
                        <label for="name">Name</label>
                    </div>
                    <div class="col-6">
                        <label name="name" value="User 1" >User 1</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-6">
                        <label name="password" value="password" >*******</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-6">
                        <label name="email" value="email" >user1@gmail.com</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3">
                        <label for="type">Type</label>
                    </div>
                    <div class="col-6">
                        <label name="type" value="type" >user</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3">
                        <label for="name">Phone</label>
                    </div>
                    <div class="col-6">
                        <label name="phone" value="phone" >097777777</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3">
                        <label for="dob">Date Of Birth</label>
                    </div>
                    <div class="col-6">
                        <label name="dob" value="dob" >6/8/96</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3">
                        <label for="address">Address</label>
                    </div>
                    <div class="col-6">
                        <label name="address" value="address" >Yangon</label>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary mr-2" value="Create">
                <Button class="btn btn-danger">Clear</button>
            </form>
        </div>
    </div>
@endsection