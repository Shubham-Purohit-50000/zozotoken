<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Redirect;
use App\Models\Coin;
use App\Models\Recharge;
use Log;

class RazorpayController extends Controller
{
    public function razorpay(Request $request)
    {        
        //return view('payment')->with('data',$request->all());
    }

    public function payment(Request $request)
    {   
        $input = $request->all();        
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id']))
        {
            try 
            {
                $coin = Coin::where('uuid', $request->coin_id)->first();
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                Recharge::create([
                    'user_id'=>$request->user_id,
                    'amount'=>$coin->amount,
                    'amount_paid'=> ($coin->amount - $coin->discount),
                    'coin_id'=>$request->coin_id,
                    'coin'=>$coin->coin,
                    'status'=>$response->status,
                    'type'=>'online',
                    'currency'=>$response->currency,
                    'razorpay_payment_id'=>$input['razorpay_payment_id'],
                ]);
            } 
            catch (\Exception $e) 
            {
                return  $e->getMessage();
                return redirect('/')->with('success', $e->getMessage());
            }            
        }
        return redirect('/')->with('success', 'Payment Successfull.');
    }
}