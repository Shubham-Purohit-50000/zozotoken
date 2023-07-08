<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coin;
use App\Models\Recharge;
use App\SabPaisa\AesCipher;
use Session;
use Log;

class PageController extends Controller
{
    public function home(){
        $coins = Coin::orderBy('amount', 'asc')->get();
        return view('home')->with('coins', $coins);
    }

    public function refundPolicy(){
        return view('refund-and-cancellation');
    }

    public function aboutUs(){
        return view('about-us');
    }

    public function contactUs(){
        return view('contact-us');
    }

    public function termOfUse(){
        return view('terms-and-conditions');
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
    {   
        $url = url('/');

        $coin = Coin::where('uuid', $request->coin_id)->first();
        $user = Session::get('user');

        /******************** code for SabPaisa Start************************** */
        $encData=null;

        $clientCode='ZOZO88';
        $username='zozotokenpayment_10207';
        $password='ZOZO88_SP10207';
        $authKey='SPlby3lGnEwsTgew';
        $authIV='f6TELIMWbA0ajGR5';

        $payerName='YUVRAJ MISHRA';
        $payerEmail='Test@sabpaisa.in';
        $payerMobile='9988776655';
        $payerAddress='Patna, Bihar';

        $clientTxnId=rand(1000,9999);
        $amount=1;
        $amountType='INR';
        $mcc=18385;
        $channelId='W';
        $callbackUrl = $url."/sab-paisa/callback";

        Log::info('callback url : '. $url);
        // Extra Parameter you can use 20 extra parameters(udf1 to udf20)
        //$Class='VIII';
        //$Roll='1008';

        $encData="?clientCode=".$clientCode."&transUserName=".$username."&transUserPassword=".$password."&payerName=".$payerName.
        "&payerMobile=".$payerMobile."&payerEmail=".$payerEmail."&payerAddress=".$payerAddress."&clientTxnId=".$clientTxnId.
        "&amount=".$amount."&amountType=".$amountType."&mcc=".$mcc."&channelId=".$channelId."&callbackUrl=".$callbackUrl;
        //."&udf1=".$Class."&udf2=".$Roll;
                        
        $AesCipher = new AesCipher(); 
        $sab_paisa_data = $AesCipher->encrypt($authKey, $authIV, $encData);

        /******************** code for SabPaisa End************************** */

        return view('payment')->with(['coin'=>$coin, 'sab_paisa_data'=>$sab_paisa_data, 'sab_paisa_clientCode'=>$clientCode]);
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

    public function deliveryShipping() {
        return view('delivery-and-shipping-policy');
    }

}
