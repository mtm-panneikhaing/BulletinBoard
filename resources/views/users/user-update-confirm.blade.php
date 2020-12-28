@extends("layouts.app")
@section("content")
<div class="container mb-3">
  <h3 class="mb-3">Update User Confirmation</h3>
    <form action="" method="post">
      @csrf
      <div class="form-row  mb-3 mt-5">
        <div class="col-3">
          <label for="name">Name</label>
        </div>
        <div class="col">
          <input type="hidden" name="name" value="{{ $user->name }}" class="form-control"/>
          <label for="name">{{ $user->name }}</label>
        </div>
      </div>
      <div class="form-row mb-5"></div>
        <div class="col-3">
            <label for="email">Email</label>
        </div>
        <div class="col">
            <input type="hidden" name="email" value="{{ $user->email }}" class="form-control"/>
            <label for="email">{{ $user->email }}</label>
        </div>
      </div>
          <input type="submit" class="btn btn-primary" value="Create">
          <a href="{{ url('/posts') }}" class="btn btn-danger ml-4"> Cancel</a>
    </form>
</div>
@endsection