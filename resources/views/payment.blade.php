@extends('layout')
@section('containt')
  @section('extra-files')
    <script src="{{asset('js/custom.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.onload = function() {
            var d = new Date().getTime();
            document.getElementById("tid").value = d;
        };
    </script>
  @endsection
  @php
      $user = Session::get('user');
  @endphp
    <!-- razorpay patment code -->
    <form action="{!!route('payment')!!}" method="POST" id="payment_form" class="d-none">
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="rzp_test_00xzW4coLY6dqu"
                data-amount="{{($coin->amount - $coin->discount)*100}}"
                data-buttontext="Pay {{($coin->amount - $coin->discount)*100}} INR"
                data-name="zozotoken"
                data-description="Payment"                             
                data-prefill.name="{{$user->name}}"
                data-prefill.email="{{$user->email}}"
                data-theme.color="#a2262e"
                id="myScript">
        </script>
        <input type="hidden" name="user_id" value="{{Session::get('user')->uuid}}">
        <input type="hidden" name="coin_id" value="{{$coin->uuid}}">
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
    </form>
    <!-- razorpay patment end code -->
    <!-- SabPaisa payment code start -->
    <form action="https://stage-securepay.sabpaisa.in/SabPaisa/sabPaisaInit?v=1" method="post" id="sab_paisa_payment_form">
        <input type="hidden" name="encData" value="2619418" id="frm1">
        <input type="hidden" name="clientCode" value ="{{$sab_paisa_clientCode}}" id="frm2">
        <input type="submit" id="sabpaisa-payment-button" name="submit">
    </form>
    <!-- SabPaisa payment code end -->
    <!-- code for ccavanue payment gateway start -->
    <form action="{{url('ccavanue/payment-request')}}" method="post" id="ccavanue_payment_form">
        <input type="text" name="tid" id="tid">
        <input type="hidden" name="merchant_id" value="{{$user->uuid}}">
        <input type="hidden" name="order_id" value="123654789">
        <input type="hidden" name="amount" value="1">
        <input type="hidden" name="currency" value="INR">
        <input type="hidden" name="user_id" value="{{Session::get('user')->uuid}}">
        <input type="hidden" name="coin_id" value="{{$coin->uuid}}">
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
    </form>
    <!-- code for ccavanue payment gateway end -->

    <div class="container">
        <div class="row my-2">
            <div class="col-12 col-md-6 text-center">
                <img src="{{asset('images/gift-box.png')}}" alt="" class="">
                <h2 class="font-weight-bold">Gift Box</h2>
            </div>
            <div class="col-12 col-md-6 card p-3">
                <h3><strong>[{{$coin->coin}}] Gift Zozo Token</strong></h3>
                <hr>
                <p><strong>₹ {{$coin->amount - $coin->discount}}</strong> @if($coin->discount > 0)<del>₹ {{$coin->amount}}</del>@endif</p>
                <h4>Description :</h4>
                <p>
                    Whether you choose to indulge in the mystery yourself or present it as a gift to someone special, the Mysterious Gift Box promises to captivate and enthrall. It's a testament to the power of curiosity and the joy of embracing the unknown. Unveil the secrets, unlock the magic, and embrace the allure of the Mysterious Gift Box – an extraordinary experience awaits.
                    <strong>Our gift box can includes gadgets, stationary, office, decoration related items</strong>.
                </p>
                <div>
                    <button class="btn btn-lg my-btn" onclick="sab_paisa()">Buy with sub-paisa</button>
                    <button class="btn btn-lg my-btn" onclick="ccavanue()">Buy with ccavanue</button>
                    
                </div>
                <div class="my-3">
                    <h4>Billing Details</h4>
                    <ul>
                        <li><strong>Product Id</strong> : {{$coin->uuid}}</li>
                        <li><strong>Name</strong> : {{$user->username}}</li>
                        <li><strong>Email</strong> : {{$user->email}}</li>
                        <li><strong>Phone</strong> : {{$user->phone}}</li>
                    </ul>
                    <p>Free Delivery, All taxes are included</p>
                    <small>Delivery time : 7 to 10 Days</small>
                    <a href="https://wa.me/918890620896" target="_blank" class="p-2  text-white rounded" style="background:#28a617;"><span><i class="fa fa-whatsapp" aria-hidden="true"></i> For any queries</span></a>
                </div>
            </div>
            <div class="col-12 mx-auto d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div><strong>Token</strong></div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none" viewBox="0 0 12 12" class="uSYgE"><path fill="#FFD200" fill-rule="evenodd" d="M6 12A6 6 0 1 0 6 0a6 6 0 0 0 0 12Z" clip-rule="evenodd"></path><path fill="#FFE749" fill-rule="evenodd" d="M6 10.125a4.125 4.125 0 1 0 0-8.25 4.125 4.125 0 0 0 0 8.25Z" clip-rule="evenodd"></path><path fill="#FEBE43" fill-rule="evenodd" d="M6.14 7.68a.3.3 0 0 0-.28 0l-1.211.637a.3.3 0 0 1-.435-.316l.231-1.35a.3.3 0 0 0-.086-.265l-.98-.955a.3.3 0 0 1 .166-.512l1.354-.197a.3.3 0 0 0 .226-.164l.606-1.228a.3.3 0 0 1 .538 0l.606 1.228a.3.3 0 0 0 .226.164l1.355.197a.3.3 0 0 1 .166.512l-.98.955a.3.3 0 0 0-.087.266L7.787 8a.3.3 0 0 1-.436.316L6.14 7.68Z" clip-rule="evenodd"></path></svg>
                                <strong>{{$coin->coin}}</strong>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div><strong>Amount</strong></div>
                            <div>
                                <strong>₹ {{$coin->amount - $coin->discount}}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-body payment-method">
                        <h5 class="mb-3">Select payment method</h5>
                        <div class="p-2 btn btn-sm d-block active my-2" onclick="razorpay()">
                            <img src="{{asset('images/razorpay.png')}}" style="height: 50px">
                        </div>
                        <div class="p-2 btn btn-sm d-block my-2 disabled" onclick="stripe()">
                            <img src="{{asset('images/stripe.png')}}" style="height: 50px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //----- code for razorpay
        function razorpay(){
            $('.razorpay-payment-button').click();
            console.log('razorpay called');
        }
        function stripe(){
            console.log('stripe called');
        }
        function sab_paisa(){
            console.log('sabpaisa called');
            $('#sabpaisa-payment-button').click();
        }
        function ccavanue(){
            console.log('ccavanue');
            $('#ccavanue_payment_form').submit();
        }
    </script>
@endsection