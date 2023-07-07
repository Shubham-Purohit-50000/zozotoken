<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coin;
use App\Models\Recharge;
use App\SabPaisa\AesCipher;
use Log;

class SabPaisaController extends Controller
{
    public function callback(Request $request){
        $query = $request->encResponse;

        $authKey = 'zvMzY0UZLxkiE6ad';
        $authIV = 'iFwrtsCSw3j7HG15';

        $decText = null;
        $AesCipher = new AesCipher();
        $decText = $AesCipher -> decrypt($authKey, $authIV, $query); 
        echo $decText;

        $token = strtok($decText,"&");

        Log::info($token);

        $i=0;

        /* response value After Decryption

        payerName=YUVRAJ MISHRA&payerEmail=yuvraj.mishra@sabpaisa.in&payerMobile=7004069540&clientTxnId=1907&payerAddress=NA&amount=10.0
        &clientCode=NITE5&paidAmount=10.1&paymentMode=Debit Card&bankName=BOB&amountType=INR&status=FAILED&statusCode=0300&challanNumber=null
        &sabpaisaTxnId=883602112220421050&sabpaisaMessage=Sorry, Your Transaction has Failed.&bankMessage=DebitCard&bankErrorCode=null
        &sabpaisaErrorCode=null&bankTxnId=101202235510088892&transDate=Wed Dec 21 16:26:28 IST 2022&udf1=NA&udf2=NA&udf3=NA&udf4=NA&udf5=NA
        &udf6=NA&udf7=NA&udf8=NA&udf9=null&udf10=null&udf11=null&udf12=null&udf13=null&udf14=null&udf15=null&udf16=null&udf17=null&udf18=null
        &udf19=null&udf20=nulli- */

        //echo $token;

        while ($token !== false)
        {
            $i=$i+1;
            $token1=strchr($token, "=");
            $token=strtok("&");
            $fstr=ltrim($token1,"=");

            //echo "i-". $i . '='. $fstr;
            //echo '<br>';

            //echo $fstr;
            if($i==2)
                $payerEmail=$fstr;
            if($i==3)
                $payerMobile=$fstr;
            if($i==4)
                $clientTxnId=$fstr;
            if($i==5)
                $payerAddress=$fstr;
            if($i==6)
                $amount=$fstr;
            if($i==7)
                $clientCode=$fstr;
            if($i==8)
                $paidAmount=$fstr;
            if($i==9)
                $paymentMode=$fstr;
            if($i==10)
                $bankName=$fstr;
            if($i==11)
                $amountType=$fstr;
            if($i==12)
                $status=$fstr;  
            if($i==13)
                    $statusCode=$fstr; 
            if($i==14)
                    $challanNumber=$fstr;
            if($i==15)
                    $sabpaisaTxnId=$fstr;
            if($i==16)
                    $sabpaisaMessage=$fstr;
            if($i==17)
                    $bankMessage=$fstr;
            if($i==18)
                    $bankErrorCode=$fstr;
            if($i==19)
                    $sabpaisaErrorCode=$fstr;
            if($i==20)
                    $bankTxnId=$fstr;				
            if($i==21)
                $transDate=$fstr;

            if($token == true)
            {
            // $up = "UPDATE  buy_now SET txid='$pgTxnId', tx_dt='$transDate', status='1' WHERE student_id='$userid'";
                //$up = "UPDATE  buy_now SET txid='$pgTxnId', tx_dt='$transDate', status=1 WHERE student_id=$ufd20";
                // echo $up;
            //  mysqli_query($conn,$up);
                
            }
        }
    }
}
