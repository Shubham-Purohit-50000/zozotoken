@extends('layout')
@section('containt')
  @section('extra-files')
    <script src="{{asset('js/custom.js')}}"></script>
  @endsection
    <div class="row">
      @if($user = !Session::get('user'))
        <div class="col-12">
          <form action="{{url('user/login')}}" method="post" id="search-form">
            @csrf
            <div class="input-group mb-3 mx-auto" style="width:400px">
              <input type="text" id="search-input" name="email" autocomplete="off" class="form-control" placeholder="Search Your Email Here" aria-label="Recipient's username" aria-describedby="basic-addon2" style="border-radius: 1rem;">
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
              </div>
            </div>
            <div class="mx-auto" style="width:400px;position:relative;">
              <ul id="search-results" class="mx-auto" style="z-index:10;position: absolute;"></ul>
            </div>

          </form>
        </div>
      @endif
        @if($user = Session::get('user'))
        <div class="col-12 text-center">
            <h4>Welcome [ {{$user->email}} ]</h4>
            <span class="d-none">Buy token and have fun!</span>
        </div>
        @endif
        <div class="col-12 p-3">
          <p class="p-3">
            Introducing our captivating and enigmatic Mysterious Gift Box, a truly exceptional offering designed to ignite intrigue and fascination. Perfect for those seeking an extraordinary experience or searching for a gift that transcends the ordinary, this box promises an unforgettable journey into the unknown.
          </p>
          <p class="p-3">
            Each Mysterious Gift Box is meticulously crafted and meticulously curated, guaranteeing an aura of anticipation and surprise. The contents within are shrouded in secrecy, ensuring an element of mystery and enchantment with every unveiling. Our team of expert artisans and creators meticulously handpick an assortment of captivating items from around the world, guaranteeing an exquisite blend of rarity, uniqueness, and charm.
          </p>
        </div>
        <div class="col-4 my-auto">
            <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4">
                <h2 class="-4"><strong>Buy Gift Box</strong></h2>
                <!-- <p class="lead">to support broadcasters</p> -->
            </div>
        </div>
        <div class="col-8 my-auto">
          <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4">
                <img src="https://www.tango.me/images/f3baf965605ea8098dd9-logo-visa.svg" alt="">
                <img src="https://www.tango.me/images/7308ad0ca674cb19ce10-logo-mastercard.svg" alt="">
                <img src="https://www.tango.me/images/69f534b04c09e0ba13b0-logo-discover.svg" alt="">
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="infoModal">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Infomation Box</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
            <p><span class="text-danger">*</span> Please search your email here or login!</p>
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          
        </div>
      </div>
    </div>
    <!-- The Modal end -->

    <div class="container-fluid">
      <div class="card-deck mb-3 text-center row">

        @foreach ($coins as $coin)
        <div class="col-6 col-md-2">
          <div class="mb-4 box-shadow my-card ribbon @if($user = Session::get('user')) pay_option @else call_modal @endif">
            <div class="wrap">
              <span class="ribbon6">OFFER {{round(100 - ($coin->amount - $coin->discount)*100/$coin->amount, 1)}}%</span>
              <div class="card-body my-body">
                <h5 class="card-title pricing-card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none" viewBox="0 0 12 12" class="uSYgE"><path fill="#FFD200" fill-rule="evenodd" d="M6 12A6 6 0 1 0 6 0a6 6 0 0 0 0 12Z" clip-rule="evenodd"></path><path fill="#FFE749" fill-rule="evenodd" d="M6 10.125a4.125 4.125 0 1 0 0-8.25 4.125 4.125 0 0 0 0 8.25Z" clip-rule="evenodd"></path><path fill="#FEBE43" fill-rule="evenodd" d="M6.14 7.68a.3.3 0 0 0-.28 0l-1.211.637a.3.3 0 0 1-.435-.316l.231-1.35a.3.3 0 0 0-.086-.265l-.98-.955a.3.3 0 0 1 .166-.512l1.354-.197a.3.3 0 0 0 .226-.164l.606-1.228a.3.3 0 0 1 .538 0l.606 1.228a.3.3 0 0 0 .226.164l1.355.197a.3.3 0 0 1 .166.512l-.98.955a.3.3 0 0 0-.087.266L7.787 8a.3.3 0 0 1-.436.316L6.14 7.68Z" clip-rule="evenodd"></path></svg>
                    <strong class="text-dark">{{$coin->coin}}</strong>
                </h5>
                <div>
                    <img src="{{asset('images/gift-box.png')}}" alt="" class="w-50">
                </div>
                <ul class="list-unstyled mt-3 mb-4">
                  <li><strong class="text-dark">₹ {{$coin->amount - $coin->discount}}</strong></li>
                  <li><del class="text-dark">₹ {{$coin->amount}}</del></li>
                </ul>
                @if($user = Session::get('user'))
                <form action="{{url('/payment-page')}}" method="post" class="d-none">
                  @csrf
                  <input type="hidden" name="coin_id" value="{{$coin->uuid}}">
                  <button type="submit" class="btn btn-lg btn-block btn-primary">Buy</button>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach

      </div>

      <div class="row my-5">
        @for ($i=1;$i<=6;$i++)
        <div class="col-xs-6 col-sm-3 col-md-2">
          @php
            $image_path = "gift-card-$i.png";
          @endphp
          <img src="{{asset('images/'.$image_path)}}" alt="" class="w-100">
        </div>
        @endfor
      </div>

    </div>
    <script>
      $('.call_modal').click(function(){
        console.log('modal called');
        $('#infoModal').modal('show');
      });
    </script>
@endsection