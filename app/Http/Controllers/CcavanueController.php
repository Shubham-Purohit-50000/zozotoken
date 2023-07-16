<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use App\Models\Coin;
use App\Models\Recharge;
use App\Models\User;
use Log;
use App\Http\Helpers\HelperClass;

class CcavanueController extends Controller
{
    public function requestHandler(Request $request)
    {

        error_reporting(0);

        $req_data = $request->all();

        $recharge = Recharge::create([
            'user_id'=> $req_data['user_id'],
            'amount' => $req_data['actual_amount'],
            'amount_paid' => $req_data['amount'],
            'coin_id' => $req_data['coin_id'],
            'coin' => $req_data['coin'],
            'type' => 'online',
            'payment_gateway' => 'ccavanue',
            'status' => 'pending',
        ]);
	
        $merchant_data='2619418';
	    $working_key='84E14B872BD9FA908CC8F74A958CD642';// live 84E14B872BD9FA908CC8F74A958CD642 Shared by CCAVENUES
	    $access_code='AVFN84KG65AH57NFHA';//for live AVFN84KG65AH57NFHA  Shared by CCAVENUES

        $cc_redirect_url = url('/').'/ccavanue/payment-response';

        $req_data['redirect_url'] = $cc_redirect_url;
        $req_data['cancel_url'] = $cc_redirect_url;
        $req_data['order_id'] = $recharge->uuid;
        
        foreach ($req_data as $key => $value){
            $merchant_data.=$key.'='.$value.'&';
        }
        $helper_class = new HelperClass();
        $encrypted_data=$helper_class->encrypt($merchant_data,$working_key);

        return view('ccavanue-payment')->with(['encrypted_data'=>$encrypted_data, 'access_code'=>$access_code]);
    }

    public function responseHandler(Request $request){

        error_reporting(0);

        $workingKey='84E14B872BD9FA908CC8F74A958CD642';	// live 84E14B872BD9FA908CC8F74A958CD642 Working Key should be provided here.
        $encResponse=$request->encResp;	
        $helper_class = new HelperClass();		//This is the response sent by the CCAvenue Server
        $rcvdString = $helper_class->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
        $order_status="";
        $order_id="";
        $decryptValues=explode('&', $rcvdString);
        $dataSize=sizeof($decryptValues);

        for($i = 0; $i < $dataSize; $i++)
        {
            $information=explode('=',$decryptValues[$i]);
            if($i==0)$order_id=$information[1];
            if($i==3)$order_status=$information[1];
        }

        $recharge = Recharge::where('uuid', $order_id)->first();

        $user_id = $recharge->user_id;
        $user = User::where('uuid', $user_id)->first();
        $request->session()->put('user', $user);
        Auth::login($user);

        if($order_status==="Success")
        {
            $recharge->status = 'success';
            $recharge->update();
            $token = $user->token + $recharge->coin;
            $user->token = $token;
            $user->update();
            return redirect('/')->with('success','Transaction successfull, Token updated!');
        }
        else if($order_status==="Aborted")
        {
            $recharge->status = 'aborted';
            $recharge->update();
            return redirect('/')->with('error','Transaction Aborted, Try again!');
        }
        else if($order_status==="Failure")
        {
            $recharge->status = 'failure';
            $recharge->update();
            return redirect('/')->with('error','Transaction Failure, Try again!');
        }
        else
        {
            return redirect('/')->with('error','Security Error. Illegal access detected!');
        }

    }

}
