@extends('layout')
@section('containt')
<div class="container mb-3">
    <h3>About Gift Box</h3>
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
    <div class="my-4">
        <div>
            <img src="{{asset('images/gift-box.png')}}" style="width:400px; float:left">
        </div>
        <strong>Our gift box can includes gadgets, stationary, office, decoration related items</strong>.</div>
    <p>
        Gift box make people feel special....
    </p>
    <p>
        They show you care. Perhaps that’s why the tradition of giving and receiving gifts has persisted throughout the ages.
    </p>
    <p>
        The best gift boxes have the potential to make gift-giving magical. Filled with a collection of themed items, the perfect gift box can deliver more joy than the sum of each component.
    </p>
    <p>
    In fact, some surveys suggest memorable gift boxes can strengthen relationships.
    </p>
    <p>
    Maybe that’s because gift boxes demonstrate that you know and care about someone enough to find multiple items that speak to their personalities, interests, and needs.
    </p>
    <p>
    When should I send a gift box?
    Sending a gift box is a great way to show your appreciation for someone special in your life. Whether it’s for a birthday, holiday, or just because, a gift box is always appreciated. And, with so many companies now offering gift box delivery, it’s easy to send one without even leaving your home.
    </p>
    <p>
    Are you ready to make your favorite people feel special?
    Send a gift box to make employees or friends feel appreciated, to celebrate their birthday, or even welcome them to a new home. Send a themed gift box for any event you want to acknowledge and celebrate in style.
    </p>

    <h4 class="mt-5">What is Gift Token? <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 12 12" class="uSYgE"><path fill="#FFD200" fill-rule="evenodd" d="M6 12A6 6 0 1 0 6 0a6 6 0 0 0 0 12Z" clip-rule="evenodd"></path><path fill="#FFE749" fill-rule="evenodd" d="M6 10.125a4.125 4.125 0 1 0 0-8.25 4.125 4.125 0 0 0 0 8.25Z" clip-rule="evenodd"></path><path fill="#FEBE43" fill-rule="evenodd" d="M6.14 7.68a.3.3 0 0 0-.28 0l-1.211.637a.3.3 0 0 1-.435-.316l.231-1.35a.3.3 0 0 0-.086-.265l-.98-.955a.3.3 0 0 1 .166-.512l1.354-.197a.3.3 0 0 0 .226-.164l.606-1.228a.3.3 0 0 1 .538 0l.606 1.228a.3.3 0 0 0 .226.164l1.355.197a.3.3 0 0 1 .166.512l-.98.955a.3.3 0 0 0-.087.266L7.787 8a.3.3 0 0 1-.436.316L6.14 7.68Z" clip-rule="evenodd"></path></svg></h4>
    <p>
        Whenever you buy any gift box, we gives you some special tokens, which you can use in your next purchase.
    </p>
</div>
@endsection