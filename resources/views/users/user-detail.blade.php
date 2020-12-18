@extends("layouts.app")
@section("content")
<div class="container ">
   <div class="row justify-content-center">
   <div class="card" style="width:400px">
        <div class="text-center">
        <img class="rounded-circle" src="../images/dog.jpg" alt="Card image" style="width:120px; height:120px; margin-top:20px;">
        </div>
        <div class="card-body">
            <h4 class="card-title text-center  mb-2">Pann Ei Khiang</h4>
            <p class="card-text mt-2">pann@gmial.com</p>
            <p class="card-text">User</p>
            <p class="card-text">0977777</p>
            <p class="card-text">6.8.96</p>
            <p class="card-text">Yangon</p>
            <a href="#" class="btn btn-primary stretched-link ml-2">Edit</a>
            <a href="#" class="btn btn-danger stretched-link ml-2">Cancel</a>
            
        </div>
    </div>
   </div>
</div>    
@endsection