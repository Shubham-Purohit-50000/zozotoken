<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Models\Coin;
use App\Models\Recharge;
use Log;
use App\Http\Helpers\HelperClass;

class CcavanueController extends Controller
{
    public function requestHandler(Request $request)
    {    
        //dd($request->all());
        error_reporting(0);
	
        $merchant_data='2619418';
	    $working_key='84E14B872BD9FA908CC8F74A958CD642';//Shared by CCAVENUES
	    $access_code='AVFN84KG65AH57NFHA';//Shared by CCAVENUES

        $request->redirect_url = url('/').'/ccavanue/payment-response';
        
        foreach ($request->all() as $key => $value){
            $merchant_data.=$key.'='.$value.'&';
        }
        $helper_class = new HelperClass();
        $encrypted_data=$helper_class->encrypt($merchant_data,$working_key);
        //return view('payment')->with('data',$request->all());
        Log::info('Encrypted value : '.$encrypted_data);

        return view('ccavanue-payment')->with(['encrypted_data'=>$encrypted_data, 'access_code'=>$access_code]);
    }

    public function responseHandler(Request $request){

        Log::info($request->all());
        error_reporting(0);

        $workingKey='84E14B872BD9FA908CC8F74A958CD642';		//Working Key should be provided here.
        $encResponse=$request->encResp;	
        $helper_class = new HelperClass();		//This is the response sent by the CCAvenue Server
        $rcvdString = $helper_class->decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
        $order_status="";
        $decryptValues=explode('&', $rcvdString);
        $dataSize=sizeof($decryptValues);

        for($i = 0; $i < $dataSize; $i++) 
        {
            $information=explode('=',$decryptValues[$i]);
            if($i==3)	$order_status=$information[1];
        }

        Log::info('Order Status : '.$order_status);

        // if($order_status==="Success")
        // {
        //     echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
            
        // }
        // else if($order_status==="Aborted")
        // {
        //     echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
        
        // }
        // else if($order_status==="Failure")
        // {
        //     echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
        // }
        // else
        // {
        //     echo "<br>Security Error. Illegal access detected";
        
        // }
    }

}
