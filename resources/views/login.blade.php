@extends('layout')
@section('containt')
<div class="container">
    <div class="my-3 row">
        <div class="col-md-6">
            <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_L7YrbxFm46.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop autoplay></lottie-player>
        </div>
        <div class="col-12 col-md-4 my-auto">
            <h2 class="mb-5"><strong>Login</strong></h2>
            <form action="{{url('manual-login')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md my-btn">Submit</button>
                </div>
            </form>
            <div>If you have not registered <a href="{{url('/registeration')}}" style="color:#a2262e">create account</a></div>
        </div>
    </div>
</div>
@endsection