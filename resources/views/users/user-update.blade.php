@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update User</div>
                    <div class="card-sub-body">
                    <div class="text-center">
                            <img class="rounded-circle" src="../images/dog.jpg" alt="Card image" style="width:120px; height:120px; margin-top:20px;">
                        </div>
                    </div>    
                    <div class="card-body">
                        <form method="POST" action="#">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                                <div class="col-md-6">
                                    <!-- <input id="type" type="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('email') }}" required autocomplete="email"> -->

                                        <select id="type" class="form-control" name="type">
                                            
                                            <option value="1">User</option>
                                            <option value="0">Admin</option>
                                            <option value="2">Visitor</option>
                                        </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>

                                <div class="col-md-6">
                                    <input id="profile" type="file" class="form-control @error('profile') is-invalid @enderror" name="profile" value="{{ old('profile') }}" required autocomplete="profile">
                                    <img id="image" style="width:100px; height:100px;" class="float-right mt-2" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4 col-form-label text-md-right">
                                    <a href="{{url('/changePassword')}}">Change Password</a>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Clear') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("profile").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("image").src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
    </script>
@endsection