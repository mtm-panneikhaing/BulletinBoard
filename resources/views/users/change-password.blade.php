@extends("layouts.app")
@section("content")
<div class="container">
        <h2 class="mb-4">Change Password </h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="old-password">Old Password</label>
                <input type="password" id="old-password" class="form-control">
            </div>
            <div class="form-group">
                <label for="new-password">New Password</label>
                <input type="password" id="new-password" class="form-control">
            </div>
            <div class="form-group">
                <label for="con-new-password">Confirm New Password</label>
                <input type="password" id="con-new-password" class="form-control">
            </div>
            <input type="submit" value="update" class="btn btn-primary">
            <input type="submit" value="Cancel" id="clear" class="btn btn-danger">
            
        </form>

    </div>
@endsection
