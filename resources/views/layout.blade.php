<!DOCTYPE html>
<html lang="en">
<head>
  <title>Zozo Token</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  @yield('extra-files')
</head>
<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">ZOZO TOKEN</a></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <div class="px-2 text-white">
          <a href="{{url('about-gift-box')}}" class="text-white mx-2" target="_blank" style="border-right: 2px solid;padding-right: 1rem;">Gift Box</a>
          @if($user = Session::get('user'))
          <span class="mr-2">Token {{$user->token}}</span>
          <img src="https://www.zozolive.com/images/{{$user->profile_image}}" alt="" style="width:45px;" class="rounded-circle">  
          <div class="dropdown d-inline">
            <span href="dropdown" class="dropdown-toggle" type="button" data-toggle="dropdown">{{$user->email}}
            <span class="caret"></span></span>
            <ul class="dropdown-menu px-2">
              <li><small>{{$user->username}}</small></li>
              <li><small>{{$user->phone}}</small></li>
              <li><small><a href="{{url('my-order', ['user_id'=>$user->uuid])}}" class="text-dark">My Order</a></small></li>
            </ul>
          </div>
          <!-- <a href="{{url('my-order', ['user_id'=>$user->uuid])}}" class="text-white py-1 px-2 border rounded mx-2">My Order</a> -->
          <a href="{{url('logout')}}" class="text-white py-1 px-2 border rounded mx-2">Logout</a>
          @else 
            <a href="{{url('login')}}" class="text-white py-1 px-2 border rounded mx-2">Login</a>
            <a href="{{url('registeration')}}" class="text-white py-1 px-2 border rounded mx-2">Registeration</a>
          @endif
        </div>
      </nav>
    </div>

    <div class="container">
      @if($message = Session::get('error'))
      <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {{$message}}
      </div>
      @elseif($message = Session::get('success'))
      <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {{$message}}
      </div>
      @endif
    </div>

    <div class="main-container">
        @yield('containt')
    </div>

    <a href="https://wa.me/918890620896" class="float" target="_blank">
      <i class="fa fa-whatsapp my-float"></i>
    </a>

    <footer class="pt-5 px-5 border-top">
        <div class="row">
          <div class="col-12 col-md-3">
            <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">ZOZO TOKEN</a></h5>
            <small class="d-block mb-3 text-muted">© {{date('Y')}}</small>
          </div>
          <div class="col-6 col-md text-muted d-none">
            <h5 class="text-white">About</h5>
            <ul class="list-unstyled text-small">
              <li><p>Address : Ajad nagar, back side of sunder wan, nawalgarh road, sikar, Rajasthan 332001</p></li>
              <li><p>Phone : 9004539476</p></li>
              <li><p>Email : zozotokenhelp@gmail.com</p></li>
              <li><p>Working Days : Mon To Sat</p></li>
              <li><p>Working Time : 10am To 6pm</p></li>
            </ul>
          </div>
          
          <div class="col-6 col-md">
            <h5 class="text-white">Important Links</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="/refund-and-cancellation">refund-and-cancellation</a></li>
              <li><a class="text-muted" href="/about-us">about-us</a></li>
              <li><a class="text-muted" href="/contact-us">contact-us</a></li>
              <li><a class="text-muted" href="/terms-and-conditions">terms-and-conditions</a></li>
              <li><a class="text-muted" href="/cookies-policy">cookies-policy</a></li>
              <li class="d-none"><a class="text-muted" href="/faq">faq</a></li>
              <li><a class="text-muted" href="/privacy-policy">privacy-policy</a></li>
              <li><a class="text-muted" href="/delivery-and-shipping-policy">delivery-and-shipping-policy</a></li>
            </ul>
            <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4">
              <img src="{{asset('images/pay-methods.png')}}" style="width:200px">
            </div>
          </div>
          <div class="col-12 text-center my-2 d-none">
            <span class="text-small text-secondary">Powered By - Ashu Live Agency</span>
          </div>
        </div>
      </footer>  

</body>
</html>
