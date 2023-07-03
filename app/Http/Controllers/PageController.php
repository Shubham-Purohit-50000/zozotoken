<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coin;
use App\Models\Recharge;

class PageController extends Controller
{
    public function home(){
        $coins = Coin::orderBy('amount', 'asc')->get();
        return view('home')->with('coins', $coins);
    }

    public function refundPolicy(){
        return view('refund-policy');
    }

    public function aboutUs(){
        return view('about-us');
    }

    public function contactUs(){
        return view('contact-us');
    }

    public function termOfUse(){
        return view('term-of-use');
    }

    public function cookiesPolicy(){
        return view('cookies-policy');
    }

    public function faq(){
        return view('faq');
    }

    public function privacyPolicy(){
        return view('privacy-policy');
    }

    public function searchEmail(Request $request){
        $emails = User::where('email', 'LIKE', "{$request->search}%")->pluck('email');
        return response()->json($emails);
    }

    public function paymentPage(Request $request)
    {   $coin = Coin::where('uuid', $request->coin_id)->first();
        return view('payment')->with('coin',$coin);
    }

    public function myOrder($user_id){
        $recharges = Recharge::where('user_id', $user_id)->latest()->get();
        //dd($recharges);
        return view('my-order')->with(['recharges'=>$recharges]);
    }

    public function cancelOrder(Request $req){
        $rec = Recharge::where('uuid', $req->recharge_id)->first();
        $rec->dummy_status = 2;
        $rec->update();
        return back()->with('success', 'Order canceled!');
    }

    public function aboutGiftBox(){
        return view('about-gift-box');
    }

}
