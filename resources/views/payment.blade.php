@extends('layout')
@section('containt')
  @section('extra-files')
    <script src="{{asset('js/custom.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  @endsection
    <!-- razorpay patment code -->
    <form action="{!!route('payment')!!}" method="POST" id="payment_form" class="d-none">
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="rzp_test_00xzW4coLY6dqu"
                data-amount="{{($coin->amount - $coin->discount)*100}}"
                data-buttontext="Pay {{($coin->amount - $coin->discount)*100}} INR"
                data-name="zozotoken"
                data-description="Payment"                             
                data-prefill.name="name"
                data-prefill.email="email"
                data-theme.color="#a2262e"
                id="myScript">
        </script>
        <input type="hidden" name="user_id" value="{{Session::get('user')->uuid}}">
        <input type="hidden" name="coin_id" value="{{$coin->uuid}}">
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
    </form>
    <!-- razorpay patment end code -->
    <div class="container"> 
        <div class="row">
            <div class="col-12 col-md-6 mx-auto">
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
    </script>
@endsection