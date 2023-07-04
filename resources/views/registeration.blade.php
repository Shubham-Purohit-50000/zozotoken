@extends('layout')
@section('containt')
<div class="container">
    <div class="my-3 row">
        <div class="col-md-6">
            <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_L7YrbxFm46.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop autoplay></lottie-player>
        </div>
        <div class="col-12 col-md-4 my-auto">
            <h2 class="mb-5"><strong>Registration</strong></h2>
            <form action="{{url('post-registration')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name">
                    @error('name')
                        <span class="text-danger">* {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    @error('email')
                        <span class="text-danger">* {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="phone" name="phone" class="form-control" placeholder="Phone">
                    @error('phone')
                        <span class="text-danger">* {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    @error('password')
                        <span class="text-danger">* {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="c_password" class="form-control" placeholder="Confirm Password">
                    @error('c_password')
                        <span class="text-danger">* {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md my-btn">Submit</button>
                </div>
            </form>
            <div>Already registered <a href="{{url('/login')}}" style="color:#a2262e">login here</a></div>
        </div>
    </div>
</div>
@endsection