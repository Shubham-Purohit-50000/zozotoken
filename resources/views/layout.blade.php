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
          @if($user = Session::get('user'))
          <span class="mr-2">Token {{$user->token}}</span>
          <img src="https://www.zozolive.com/images/{{$user->profile_image}}" alt="" style="width:45px;" class="rounded-circle"> 
          {{$user->email}} 
          <a href="{{url('logout')}}" class="text-white py-1 px-2 border rounded mx-2">Logout</a>
          @else 
            <a href="{{url('login')}}" class="text-white py-1 px-2 border rounded mx-2">Login</a>
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

    <footer class="pt-5 px-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">ZOZO TOKEN</a></h5>
            <small class="d-block mb-3 text-muted">© {{date('Y')}}</small>
          </div>
          <div class="col-6 col-md text-muted">
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
              <li><a class="text-muted" href="/refund-policy">refund-policy</a></li>
              <li><a class="text-muted" href="/about-us">about-us</a></li>
              <li><a class="text-muted" href="/contact-us">contact-us</a></li>
              <li><a class="text-muted" href="/term-of-use">term-of-use</a></li>
              <li><a class="text-muted" href="/cookies-policy">cookies-policy</a></li>
              <li class="d-none"><a class="text-muted" href="/faq">faq</a></li>
              <li><a class="text-muted" href="/privacy-policy">privacy-policy</a></li>
            </ul>
            <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4">
                <img src="https://www.tango.me/images/f3baf965605ea8098dd9-logo-visa.svg" alt="">
                <img src="https://www.tango.me/images/7308ad0ca674cb19ce10-logo-mastercard.svg" alt="">
                <img src="https://www.tango.me/images/ad33c5d3b6d9706d8881-logo-ae.svg" alt="">
                <img src="https://www.tango.me/images/69f534b04c09e0ba13b0-logo-discover.svg" alt="">
                <img src="https://www.tango.me/images/2bd93e33c07344370027-logo-ssl.svg" alt="">
            </div>
          </div>
        </div>
      </footer>  

</body>
</html>
